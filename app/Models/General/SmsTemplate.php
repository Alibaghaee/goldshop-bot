<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;

class SmsTemplate extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'sms_templates';

    protected $guarded = [];

    public static $VERIFIED = 'تایید سفر';
    public static $CANCELED = 'لغو سفر';
    public static $NOT_CANCEL = 'خطای لغو سفر';
    public static $GUIDE_INFO = 'لینک راهنما';
    public static $STORE_TRAVEL = 'ثبت سفر';
    public static $WARNING_WALLET_CHARCH = 'هشدار کمبود شارژ';
    public static $REASON_TRAVEL = 'پیدانکردن علت سفر';
    public static $SYMBOLE_SYNTAX = 'الگوی نادرست ثبت سفر';
    public static $WALLET_BALANCE = 'باقیمانده شارژ';
    public static $GET_SUBSCRIP_CODE = 'دریافت کداشتراک';
    public static $HOLY_DAY_ERROR = 'روز تعطیل';
    public static $SEND_GATEWAY_LINK = 'ارسال لینک درگاه';
    public static $SEND_GATEWAY_LINK_ERROR = 'خطای ارسال لینک درگاه';
    public static $WALLET_CHARCH_ERROR = 'خطای کمبود شارژ';
    public static $WALLET_CHARCH = 'تایید شارژ';

    public static $tagList = [
        ['id' => 1, 'name' => 'تایید سفر'],
        ['id' => 2, 'name' => 'لغو سفر'],
        ['id' => 3, 'name' => 'لینک راهنما'],
        ['id' => 4, 'name' => 'ثبت سفر'],
        ['id' => 5, 'name' => 'هشدار کمبود شارژ'],
        ['id' => 6, 'name' => 'پیدانکردن علت سفر'],
        ['id' => 7, 'name' => 'الگوی نادرست ثبت سفر'],
        ['id' => 8, 'name' => 'خطای لغو سفر'],
        ['id' => 9, 'name' => 'باقیمانده شارژ'],
        ['id' => 10, 'name' => 'دریافت کداشتراک'],
        ['id' => 11, 'name' => 'روز تعطیل'],
        ['id' => 12, 'name' => 'ارسال لینک درگاه'],
        ['id' => 13, 'name' => 'خطای ارسال لینک درگاه'],
        ['id' => 14, 'name' => 'خطای کمبود شارژ'],
        ['id' => 15, 'name' => 'تایید شارژ'],
    ];

    public static function getMessageWithTag(string $tag, string $default)
    {
        if (self::where('tag', 'like', '%' . $tag . '%')->exists()) {


            return self::where('tag', 'like', '%' . $tag . '%')->first()->description;
        } else {

            return $default;
        }
    }



    // {{dont_delete_this_comment}}
}
