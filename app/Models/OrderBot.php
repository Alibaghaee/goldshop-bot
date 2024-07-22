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

    const SELL = '/sell';

    const BUY = '/buy';

    const SELL_US_ORDER = 'sell_us_order';

    const BUY_FROM_US_ORDER = 'buy_from_us_order';
    const ABSHODE = '/trade_abshode';

    const COIN = '/trade_coin';
    const MANUAL_ORDER_SUBMISSION = 'manual_order_submission';


    public static $typeList = [];
    public static $itemList = [];

    public static function initializeTypeList()
    {
        self::$typeList = [
            ['id' => self::SELL, 'name' => 'فروش'],
            ['id' => self::SELL_US_ORDER, 'name' => 'فروش'],
            ['id' => self::BUY, 'name' => 'خرید'],
            ['id' => self::BUY_FROM_US_ORDER, 'name' => 'خرید'],
        ];
    }

    public static function initializeItemList()
    {
        self::$itemList = [
            ['id' => self::COIN, 'name' => 'سکه'],
            ['id' => self::MANUAL_ORDER_SUBMISSION . '_' . self::COIN, 'name' => 'سکه'],
            ['id' => self::ABSHODE, 'name' => 'آبشده'],
            ['id' => self::MANUAL_ORDER_SUBMISSION . '_' . self::ABSHODE, 'name' => 'آبشده'],
        ];
    }

    public static function beautyCurrency($price)
    {
        return number_format((float)$price, 3, '.', ',');
    }

    protected static function boot()
    {
        parent::boot();

        self::initializeTypeList();
        self::initializeItemList();

        static::created(function (OrderBot $orderBot) {

            $setting = SettingBot::where('bot_tag', SettingBot::$MMD_TALA)->first();
            if ($orderBot->type === self::SELL || $orderBot->type === self::SELL_US_ORDER) {

                $type = 'فروش به ما';

            } else {
                $type = 'خرید از ما';
            }

            if ($orderBot->item === self::COIN || $orderBot->item === self::MANUAL_ORDER_SUBMISSION . '_' . self::COIN) {

                $item = 'سکه';
            } else {

                $item = 'آبشده';
            }


            $text = "نوع خرید:$type \n" . "عملیات موردنظر:$item \n";

            if ($item === 'آبشده') {
                $text = $text . sprintf("وزن:%s", self::beautyCurrency($orderBot->weight)) . "\n";
                $text = $text . "قیمت کل:" . self::beautyCurrency(((float)$orderBot->price * (float)$orderBot->weight)) . "\n";
                $balance = $setting->abshode_balance;

            } else {

                $text = $text . sprintf("تعداد:%s", $orderBot->count) . "\n";
                $text = $text . "قیمت کل:" . self::beautyCurrency(((float)$orderBot->price * (int)$orderBot->count)) . "\n";
                $balance = $setting->coin_balance;

            }
            $text = $text . "قیمت خرید هر $item:" . self::beautyCurrency($orderBot->price) . "\n";

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

    public function getTypeFaAttribute()
    {
        return optional(collect(self::$typeList)->firstWhere('id', $this->type))['name'];
    }

    public function getItemFaAttribute()
    {
        return optional(collect(self::$itemList)->firstWhere('id', $this->item))['name'];
    }


    public function getPriceBeAttribute()
    {
        return self::beautyCurrency($this->price);
    }


}
