<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Morilog\Jalali\Jalalian;

class Blacklist extends Model
{
    use Uri, View, Filterable;

    protected $table = 'blacklist_repository';

    protected $route_name = 'blacklists';

    public $timestamps = false;

    protected $guarded = [];

    protected $appends = ['sendable_parts_count'];

    public function __construct()
    {
        parent::__construct();

        $this->connection = config('portal.5m5_db_connection');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('date', function (Builder $builder) {
            $builder->where('date', '>', config('portal.blacklists_date_limit'));
        });
    }

    public function user()
    {
        return $this->belongsTo('App\Models\General\SmsUser', 'user_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\General\SmsAdmin', 'admin_id', 'id');
    }

    public function staff()
    {
        return $this->setConnection('mysql')->belongsTo('App\Models\General\Admin', 'staff_id', 'id');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\General\Operator' . $this->table_name, 'sms_group', 'sms_group');
    }

    public function sendables()
    {
        return $this->messages->where('deliver_state', 5)->where('blacklist_status', 0);
    }

    public function getDateAttribute($value)
    {
        return Carbon::createFromTimestamp($value)->toDateTimeString();
    }

    public function getUserLinkAttribute($value)
    {
        return 'http://5m5.ir/admin/contents.php?page=user_info&id=' . $this->user_id;
    }

    public function getSendableCountAttribute()
    {
        return $this->sendables()->count();
    }

    public function getSendedCountAttribute()
    {
        return $this->messages->where('deliver_state', 5)->where('blacklist_status', 1)->count();
    }

    public function getNeededCashAttribute()
    {
        return $this->sendables()->sum('long') * user_blacklist_price($this);
    }

    public function singleSendUserPrice()
    {
        return $this->messages->first()->long * user_blacklist_price($this);
    }

    public function getLackOfCashAttribute()
    {
        $result = $this->needed_cash - $this->user->cash;

        return $result < 0 ? 0 : $result;
    }

    public function checkForLackOfCash()
    {
        if ($this->sendable_count == 0) {
            return;
        }

        if ($this->user->cash < $this->singleSendUserPrice()) {
            $this->update(['status' => 2]);
        }
    }

    /**
     * if there are any sendable message and the user has enough cash put the record in queue
     * @return void
     */
    public function checkForEnoughOfCash()
    {
        if ($this->sendable_count == 0) {
            return;
        }

        if ($this->user->cash > $this->singleSendUserPrice()) {
            $this->update(['status' => 0]); // put in queue
        }
    }

    public function getBlacklistTypeTitleAttribute()
    {
        return optional(collect(config('portal.blacklist_types'))->where('id', $this->blacklist_type)->first())['name'];
    }

    public function getSenderNumberAttribute($value)
    {
        return optional($this->messages->first())->sender_number;
    }

    public function getMessagesCountAttribute($value)
    {
        return $this->messages->count();
    }

    public function getMessagesBlacklistCountAttribute($value)
    {
        return $this->messages->where('deliver_state', 5)->count();
    }

    public function getDeliverStatusAttribute()
    {
        if (in_array($this->table_name, ['9821', '50004', '3000', '5700', '1000'])) {
            if ($this->has_message_in_queue) {
                return false;
            }
            return true;
        }

        return !(bool) $this->messages->where('deliver_state', 0)->count();
    }

    public function getHasMessageInQueueAttribute()
    {
        return $this->messages->where('state', '!=', 0)->count() != 0;
    }

    public function getDateFaAttribute()
    {
        return Jalalian::fromDateTime($this->date)->format('Y/m/d H:i');
    }

    public function getSendablePriceForUserAttribute()
    {
        return $this->sendable_count * user_blacklist_price($this);
    }

    public function getSendablePriceForAdminAttribute()
    {
        return $this->sendable_count * admin_blacklist_price($this);
    }

    public function getIrancellBlacklistsCountAttribute()
    {
        return $this->sendables()->filter(function ($item) {
            $irancell_prefixes = Arr::get(config('portal.mobile_prefixes'), 'irancell', []);
            foreach ($irancell_prefixes as $value) {
                if (strpos($item->number, $value) === 0) {
                    return true;
                }
            }
            return false;
        })->count();
    }

    public function getSendablePartsCountAttribute()
    {
        return $this->sendable_count * $this->message_part;
    }

    public function getSendedBlacklistsExportURLAttribute()
    {
        return '/blacklists/blacklists/export_sends_all/' . $this->id;
    }

    public function checkForEnd()
    {
        if ($this->sendable_count == 0 && $this->deliver_status) {
            $this->update(['status' => 1]);
        }
    }

    public function sendedBlacklistNumbers()
    {
        $numbers = $this
            ->messages
            ->where('deliver_state', 5)
            ->pluck('number')
            ->toArray();

        return get_export_numbers($numbers);
    }

    public function exportFilesList()
    {
        $path = storage_path('app/exports/' . $this->id);
        $data = is_dir($path) ? File::allFiles($path) : null;

        $files = [];

        if (blank($data)) {
            return $files;
        }

        foreach ($data as $key => $file) {
            $date    = Carbon::createFromTimestamp($file->getATime())->toDateTimeString();
            $date_fa = Jalalian::fromDateTime($date)->format('H:i Y/m/d');

            $files[$key]['date']     = $file->getATime();
            $files[$key]['date_fa']  = $date_fa;
            $files[$key]['path']     = $file->getPath();
            $files[$key]['filename'] = $file->getFilename();
            $files[$key]['pathname'] = $file->getPathname();
            $files[$key]['size']     = $file->getSize();
            $files[$key]['url']      = '/blacklists/blacklists/export_sends_partial/' . $this->id . '/' . $file->getFilename();
        }

        return $files;
    }

    public function scopeQueue($query)
    {
        return $query->where('status', 0);
    }

    public function scopeCustomStatusOrder($query)
    {
        return $query->orderByRaw('CASE status WHEN 0 THEN 3 WHEN 2 THEN 2 WHEN 1 THEN 1 ELSE 0 END DESC');
    }

    public function scopeLackOfCash($query)
    {
        return $query->where('status', 2);
    }

    public function scopeCheckableForEnd($query)
    {
        return $query->whereIn('status', [0, 2]);
    }

    public function log()
    {
        return $this->setConnection('mysql')->hasMany('App\Models\General\BlacklistSendLog', 'blacklist_id');
    }

    /**
     * @return integer
     */
    public static function totalQueueNoteParts()
    {
        return static::queue()->get()->sum('sendable_parts_count');
    }

    /**
     * @return integer
     */
    public static function totalLackOfCashNoteParts()
    {
        return static::lackOfCash()->get()->sum('sendable_parts_count');
    }

    public function setSmsCache()
    {
        if (Cache::has($this->sms_group)) {
            Cache::increment($this->sms_group);
        } else {
            Cache::put($this->sms_group, '1', now()->addDays(7));
        }
    }

    public function getSendedSmsCountCacheAttribute()
    {
        if (Cache::has($this->sms_group)) {
            return Cache::get($this->sms_group);
        } else {
            return '';
        }
    }

    // {{dont_delete_this_comment}}
}
