<?php

namespace App\Models\General;

use App\Events\SingleSmsSenderEvent;
use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class SingleSmsSender extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'single_sms_senders';

    protected $guarded = [];

    public static $STATUS_LIST = [
        ['id' => 'pending', 'name' => 'درانتظار'],
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

        static::created(function (SingleSmsSender $model) {

//            call event
            event(new SingleSmsSenderEvent($model));

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
     * Define an inverse one-to-one or many relationship to ContactNumber.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contactNumber()
    {
        return $this->belongsTo(ContactNumber::class);
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

    // {{dont_delete_this_comment}}
}
