<?php

namespace App\Models;

use App\Models\General\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class OrderBot extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'item',
        'price',
        'count',
        'weight',
        'status',
        'user_id',
        'admin_id'
    ];

    public static $SELL = '/sell';

    public static $BUY = '/buy';

    public static $SELL_US_ORDER = 'sell_us_order';

    public static $BUY_FROM_US_ORDER = 'buy_from_us_order';
    public static $ABSHODE = '/trade_abshode';

    public static $COIN = '/trade_coin';
    public static $MANUAL_ORDER_SUBMISSION = 'manual_order_submission';

    protected static function boot()
    {
        parent::boot();

        static::created(function (OrderBot $orderBot) {

            $setting=SettingBot::where('bot_tag', SettingBot::$MMD_TALA)->first();
            if ($orderBot->type === self::$SELL || $orderBot->type === self::$SELL_US_ORDER) {

                $type = 'فروش به ما';

            } else {
                $type = 'خرید از ما';
            }

            if ($orderBot->item === self::$COIN || $orderBot->item === self::$MANUAL_ORDER_SUBMISSION . '_' . self::$COIN) {

                $item = 'سکه';
            } else {

                $item = 'آبشده';
            }


            $text = "نوع خرید:$type \n" . "عملیات موردنظر:$item \n";

            if ($item === 'آبشده') {
                $text = $text . sprintf("وزن:%s", $orderBot->weight) . "\n";
                $text = $text . "قیمت کل:" . (string)((float)$orderBot->price * (float)$orderBot->weight) . "\n";
                $balance=$setting->coin_balance;

            } else {

                $text = $text . sprintf("تعداد:%s", $orderBot->count) . "\n";
                $text = $text . "قیمت کل:" . (string)((float)$orderBot->price * (int)$orderBot->count) . "\n";
                $balance=$setting->abshode_balance;

            }
            $text = $text . "قیمت خرید هر $item:" . "$orderBot->price" . "\n";

            $text = $text . "شماره مشتری:" . $orderBot->user->mobile . "\n";
            $text = $text . "نام نام خانوادگی مشتری:" . $orderBot->user->name . "\n";
            $text = $text . "تاریخ معامله:" . $orderBot->created_at_fa . "\n";

            $text = $text . "تراز کنونی:" . $balance . "\n";

            collect(MessageBot::managerIds())->each(function ($botId) use ($text) {
                MessageBot::sendGlobalCustomChatAloneText($botId['id'], $text);
            });

        });
    }

    /**
     * Define an inverse one-to-many relationship to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define an inverse one-to-many relationship to Admin.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }


    public function getCreatedAtFaAttribute()
    {
        return Jalalian::fromDateTime($this->created_at)->format('Y/m/d H:i');
    }
}
