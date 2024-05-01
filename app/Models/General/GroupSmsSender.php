<?php

namespace App\Models\General;

use App\Events\GroupSmsSenderEvent;
use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class GroupSmsSender extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'group_sms_senders';

    public static $STATUS_LIST = [
        ['id' => 'pending', 'name' => 'درانتظار'],
        ['id' => 'sending', 'name' => 'درحال ارسال'],
        ['id' => 'sent', 'name' => 'ارسال شده'],
        ['id' => 'not_sended', 'name' => 'ارسال نشده'],
    ];

    public static $TYPE_LIST = [
        ['id' => 'normal', 'name' => 'عادی'],
//        ['id' => 'black_list', 'name' => 'درصورت بلاکی ارسال از خدماتی'],
    ];


    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function (GroupSmsSender $model) {

//            call event
            event(new GroupSmsSenderEvent($model));
        });
    }

    public static function getStatusArray($id)
    {
        if (collect(self::$STATUS_LIST)
                ->where('id', $id)->count() > 0) {

            return collect(self::$STATUS_LIST)
                ->where('id', $id)
                ->first();
        }
        return [];
    }


    public function transList($id, $list)
    {
        if (collect($list)
                ->where('id', $id)->count() > 0) {

            return collect($list)
                ->where('id', $id)
                ->first()['name'];
        }
        return 'undefined';
    }


    public function getStatusFaAttribute()
    {
        return $this->transList($this->status, self::$STATUS_LIST);
    }

    public function getTypeFaAttribute()
    {
        return $this->transList($this->type, self::$TYPE_LIST);
    }

    public function getCreatedAtFaAttribute()
    {
        return Jalalian::fromDateTime($this->created_at)->format('Y/m/d H:i');
    }

    /**
     * Define an inverse one-to-one or many relationship to ContactCategory.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contactCategory()
    {
        return $this->belongsTo(ContactCategory::class);
    }

    /**
     * Define an inverse one-to-one or many relationship to SenderNumber.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function senderNumber()
    {
        return $this->belongsTo(SenderNumber::class);
    }

    protected $guarded = [];

    // {{dont_delete_this_comment}}
}
