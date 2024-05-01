<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\HasPublishedScope;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SenderNumber extends Model
{
    use Uri, View, Filterable, HasPublishedScope;

    protected $route_name = 'sender_numbers';


    public static $STATUS_LIST = [
        ['id' => 'pending', 'name' => 'غیرفعال'],
        ['id' => 'published', 'name' => 'فعال'],
    ];

    public static $TYPE_LIST = [
        ['id' => 'normal', 'name' => 'عادی'],
        ['id' => 'black_list', 'name' => 'خدماتی'],
    ];

    public static $DARGAH_LIST = [
        ['id' => '1000', 'name' => 'رهیاب'],
        ['id' => '9821', 'name' => 'آسانک'],
        ['id' => '3000', 'name' => 'مگفا'],
        ['id' => '50004', 'name' => 'ارمغان'],
        ['id' => '5700', 'name' => 'اسمارت'],
        ['id' => '2000', 'name' => 'آتیه'],
        ['id' => '989999', 'name' => 'سامان تل'],
        ['id' => '9998', 'name' => 'آرین تل'],
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function (SenderNumber $model) {

            $model->setAttribute('dargah', self::returnDargah($model->number));
        });
    }

    public static function returnDargah($number)
    {
        foreach (self::$DARGAH_LIST as $dargah) {
            if ($dargah['id'] === mb_substr($number, 0, strlen($dargah['id']))) {

                return $dargah['id'];
            }
        }

        return null;
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

    public static function getTypeArray($id)
    {
        if (collect(self::$TYPE_LIST)
                ->where('id', $id)->count() > 0) {

            return collect(self::$TYPE_LIST)
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

    public function getDargahFaAttribute()
    {
        return $this->transList($this->dargah, self::$DARGAH_LIST);
    }


    public static function scopeAsOptionWithType($query)
    {

        return $query->select(\DB::raw("CONCAT(number,'  ',type) as name"), 'id');
    }

    public static function scopeAsOption($query)
    {

        return $query->select("number as name", 'id');
    }


    /**
     * Define an inverse one-to-one or many relationship to PanelSms.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function panelSms()
    {
        return $this->belongsTo(PanelSms::class);
    }

    public function scopeOwnerPanel(Builder $query)
    {
        return $query->whereHas('panelSms', function (Builder $query) {

            return $query->where('type', 'owner');
        });
    }

    public function scopePublishedPanel(Builder $query)
    {
        return $query->whereHas('panelSms', function (Builder $query) {

            return $query->where('status', 'published');
        });
    }

    protected $guarded = [];

    // {{dont_delete_this_comment}}
}
