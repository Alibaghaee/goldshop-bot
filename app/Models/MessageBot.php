<?php

namespace App\Models;

use App\Service\TellBot\TelegramServiceController;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Telegram\Bot\Keyboard\Keyboard;

class MessageBot extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'update_id',
        'message_id',
        'from_id',
        'from_is_bot',
        'from_first_name',
        'from_last_name',
        'from_language_code',
        'date',
        'text',
        'callback_query',
        'callback_query_text',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime',
        'from_is_bot' => 'boolean',
        'callback_query' => 'boolean',
    ];

    public static $START_TRADE = '/start_trade';

    public static $SELL = '/sell';

    public static $BUY = '/buy';

    public static $ABSHODE = '/trade_abshode';

    public static $COIN = '/trade_coin';

    public static $START = '/start';

    public static $NEED_PHONE = 'need_phone';

    public static $NEED_USER_CHECK = 'need_user_check';

    public static $WEIGHT = '/weight';

    public static $PRICE = '/price';

    public static $SET_TRADE_AMOUNT = 'set_trade_amount';

    public static $RECIVE_COIN_AMOUNT = 'receive_coin_amount';

    public static $CONFIRM = 'confirm';

    public static $SETUP_COIN_TRADE = 'setup_coin_trade';

    public static $RECIVE_PHONE = 'receive_phone';

    public static $SET_TRADE_TYPE = 'set_trade_type';

    public static $START_TRADE_ACTION = 'start_trade';

    public static $START_ACTION = 'start_bot';

    public static $BACK = '/back';

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function (MessageBot $message) {
            if ($message->chatSessionCheck()) {


                $message->chatSessionClear();
            }
            if (!$message->from_is_bot && self::checkLockConversation()) {

                if ($message->callback_query) {
                    $message->destroyMessage();
                    if (trim($message->callback_query_text) === self::$START_TRADE) {

                        $message->startTrade();
                    }

                    if (trim($message->callback_query_text) === self::$BACK) {

                        $message->redirectBack();
                    }

                    if (trim($message->callback_query_text) === self::$SELL || trim($message->callback_query_text) === self::$BUY) {

                        $message->setTradeType();
                    }

                    if (trim($message->callback_query_text) === self::$ABSHODE || trim($message->callback_query_text) === self::$COIN) {

                        $message->setTradeItem();
                    }

                    if (trim($message->callback_query_text) === self::$CONFIRM) {
                        if ($message->last_action === self::$SETUP_COIN_TRADE) {

                            $message->endSetupCoinTrade();
                        }
                    }

                } else {

                    if (trim($message->text) === self::$START) {

                        $message->startBot();
                    } elseif ($message->last_action === self::$NEED_PHONE) {
                        if (str_contains(trim($message->text), 'contact:')) {


                            $message->receivePhone();
                        }
                    } elseif ($message->last_action === self::$NEED_USER_CHECK) {
                        $message->receiveName();
                    } elseif ($message->last_action === self::$SET_TRADE_AMOUNT && $message->session_item === self::$COIN) {

                        $message->receiveTradeCoinAmount();
                    }
                }


            } else {

                $message->lockConversation();
            }

        });
    }


    public static function checkLockConversation()
    {

        return true;
    }


    public function needPhone()
    {
        $this->setRouteAction(self::$NEED_PHONE);


        $this->sendTextWithBtn(
            'با سلام خدمت شما دوست عزیز. از طریق این بات می توانید سفارش خود را به سادگی ثبت کنید. برای بازگشت بین مراحل از دستور <<↪️ بازگشت>> کنید. اگر آماده هستید با فشردن دکمه اشتراگ گذاری شماره همراه ادامه دهید.',
            ['به اشتراک گذاری شماره تلفن همراه'],
            true
        );


    }

    public function needUserCheck()
    {
        $this->setRouteAction(self::$NEED_USER_CHECK);


        $this->sendAloneText(
            "دوست عزیز شماره شما برای ثبت سفارش مجاز نشده است لطفا پس از بررسی با ادمین مجددا بررسی کنید.\nشماره ادمین سیستم:+989381807373\nایدی ادمین:@mohammadmostaviii" . "\n" . "برای دسترسی اسان تر لطفا نام خانوادگی خود را وارد کنید",
            true);
    }

    public function lockConversation()
    {
        $this->sendAloneText('همکار گرامی زمان معامله به پایان رسیده لطفا با شماره 09381807373 تماس حاصل نمایید');

    }

    public function receiveName()
    {
        $this->chatBot?->user->tryActiveMobile();
        $this->sendAloneText("با تشکر بابت اطلاعات ثبت شده. مشخصات شما برای ادمین ارسال شد. منتظر تماس پشتیبانی بمانید", true);


    }

    public function receiveTradeCoinAmount()
    {

        $text = (int)to_english_numbers($this->text);
        if ($text === 0) {

            return $this->sendAloneText("تعداد وارده معتبر نیست. لطفا دوباره تلاش کنید ...", true);
        }

        $this->setRouteAction(self::$RECIVE_COIN_AMOUNT);

        if ($this->session_item === self::$COIN) {

            $this->setCoinAmount($text);

            return $this->setupCoinTrade();
        }
    }

    public function setupCoinTrade()
    {
        $this->setRouteAction(self::$SETUP_COIN_TRADE);


        $this->setTotalInvoice($this->getTotalCoinPrice($this->session_type));

        $lable = $this->session_type === self::$SELL ? "🔵" : "🔴";
        $time = time_fa($this->created_at);
        $text = "نوع خرید: {$this->session_item_fa}\nعملیات مورد نظر: {$this->session_type_fa}\nتعداد: {$this->session_coin_amount}\nقیمت {$this->session_type_fa} هر سکه امامی: {$this->getCoinPrice($this->session_type)}  $lable \nقیمت کل: {$this->getTotalCoinPrice($this->session_type)}\nشماره مشتری: +{$this->chatBot?->user?->phone}\nنام و نام خانوادگی مشتری: {$this->chatBot?->user?->fullname}\nتاریخ معامله: $time";


        $this->sendTextWithInlineBtn($text, ["بله تایید میکنم" => self::$CONFIRM], true);


    }

    public function endSetupCoinTrade()
    {

        if ((int)$this->session_total_invoice !== (int)$this->getTotalCoinPrice($this->session_type)) {
            $this->chatSessionClear();
            return $this->sendTextWithInlineBtn("قیمت ها به روزرسانی شده اند لطفا دوباره تلاش کنید", ["شروع مجدد" => self::$START_TRADE]);
        }
        $this->chatSessionClear();
        return $this->sendAloneText("معاملات شما با موفقیت انجام شد. از حسن اعتماد شما متشکریم. منتظر تماس پشتیبانی باشید.");

    }


    public function receivePhone()
    {
        $this->setRouteAction(self::$RECIVE_PHONE);

        $phone = explode(':', $this->text);
        if (array_key_exists(1, $phone) && !$this->has_user) {

            $user = \App\Models\User::create(['phone' => str_replace('_98', '0', $phone[1]), 'last_chat_id' => $this->chatBot?->chat_id]);
            $this->chatBot?->user()->associate($user)->save();
        }

        $this->startBot();
    }

    public function setTradeItem()
    {

        $this->setItem(trim($this->callback_query_text));

        return $this->tradeType();
    }

    public function setTradeType()
    {

        $this->setType(trim($this->callback_query_text));

        return $this->tradeAmount();
    }


    public function startBot()
    {
        $this->setRouteAction(self::$START_ACTION);
        $this->setStartBot(true);


        $this->sendTextWithInlineBtn("به ربات معامله گر خوش آمدید \n پس از آمادگی دکمه شروع معامله را انتخاب کنید. ", ['شروع معامله' => self::$START_TRADE]);


    }

    public function startTrade()
    {
        $this->setRouteAction(self::$START_TRADE_ACTION);


        if (!$this->has_user) {

            return $this->needPhone();

        }

        if (!$this->valid_user) {


            return $this->needUserCheck();
        }

        $this->setStartTrade(true);


        $this->sendTextWithInlineBtn('لطفا نوع معامله را مشخص کنید', ["آبشده" => self::$ABSHODE, 'سکه' => self::$COIN], true);
    }

    public function tradeType()
    {
        $this->setRouteAction(self::$SET_TRADE_TYPE);

        $this->sendTextWithInlineBtn('لطفا نحوه مبادله را مشخص کنید', ["فروش به ما" => self::$SELL, "خرید از ما" => self::$BUY], true);
    }

    public function tradeAmount()
    {
        $this->setRouteAction(self::$SET_TRADE_AMOUNT);


        if ($this->session_item === self::$COIN) {
            if ($this->session_type === self::$SELL) {
                $text = "قیمت فروش هر سکه امامی: " . $this->getCoinPrice(self::$SELL) . "🔵";

            } else {
                $text = "قیمت خرید هر سکه امامی: " . $this->getCoinPrice(self::$BUY) . "🔴";
            }
            $text = $text . "\n" . "لطفا تعداد سکه را وارد نمایید\n👇👇👇";

            $this->sendAloneText($text, true);

        } else {


            $this->sendTextWithInlineBtn("لطفا واحد عملیات مبادله را مشخص کنید.", ["وزن" => self::$WEIGHT, "مبلغ" => self::$PRICE], true);
        }
    }


    public function setRouteAction(string $value)
    {

        $this->getCleanChatSession()?->chatRoutes()->create(['action' => $value])->save();
    }


    public function getCleanChatSession()
    {
        if ((!$this->has_chat_session) || $this->chatSessionCheck()) {
            $this->chatSessionClear();

            $chatSession = ChatSession::create();

            $this->chatBot->chatSession()->associate($chatSession)->save();

            return $this->chatBot?->chatSession;
        } else {

            return $this->chatBot?->chatSession;
        }
    }

    public function getCoinPrice(string $type)
    {
        return '1000000';
    }

    public function getTotalCoinPrice(string $type)
    {
        return $this->getCoinPrice($type) * $this->session_coin_amount;
    }

    public function getHasUserAttribute()
    {
        return $this->chatBot?->user()?->exists();
    }

    public function getValidUserAttribute()
    {

        return $this->chatBot?->user?->active_mobile;
    }

    public function getLastActionAttribute()
    {

        return $this->getCleanChatSession()->chatRoutes?->sortByDesc('id')?->first()?->action;
    }

    public function chatSessionCheck()
    {
        return $this->chatBot?->chatSession?->updated_at <= now()->subHour();
    }

    public function getHasChatSessionAttribute()
    {
        return $this->chatBot?->chatSession()->exists();
    }

    public function chatSessionClear()
    {


        $this->chatBot?->chatSession?->delete();

    }

    public function setItem(string $value)
    {

        $this->getCleanChatSession()->setItem($value);
    }

    public function getSessionItemAttribute()
    {

        return $this->getCleanChatSession()->item;
    }

    public function getSessionItemFaAttribute()
    {

        return $this->session_item === self::$COIN ? 'سکه' : 'آبشده';
    }


    public function setStartBot(bool $value)
    {

        $this->getCleanChatSession()->setStartBot($value);
    }

    public function getSessionStartBotAttribute()
    {

        return $this->getCleanChatSession()->start_bot;
    }

    public function setStartTrade(bool $value)
    {

        $this->getCleanChatSession()->setStartTrade($value);
    }

    public function getSessionStartTradeAttribute()
    {

        return $this->getCleanChatSession()->start_trade;
    }


    public function setType(string $value)
    {

        $this->getCleanChatSession()->setType($value);
    }

    public function getSessionTypeAttribute()
    {

        return $this->getCleanChatSession()->type;
    }

    public function getSessionTypeFaAttribute()
    {

        return $this->session_type === self::$SELL ? 'فروش' : 'خرید';
    }

    public function setCoinAmount(string $value)
    {

        $this->getCleanChatSession()->setCoinAmount($value);
    }

    public function getSessionCoinAmountAttribute()
    {

        return $this->getCleanChatSession()->coin_amount;
    }

    public function setTotalInvoice(string $value)
    {

        $this->getCleanChatSession()->setTotalInvoice($value);
    }

    public function getSessionTotalInvoiceAttribute()
    {

        return $this->getCleanChatSession()->total_invoice;
    }


    public function destroyMessage()
    {
        (new TelegramServiceController())->deleteMessage($this->chatBot->chat_id, $this->message_id);
    }


    public function sendAloneText($text, $withBackBtn = false)
    {

        $data = [
            'chat_id' => $this->chatBot->chat_id,
            'text' => $text,
        ];
        if ($withBackBtn) {

            $reply_markup = Keyboard::make()
                ->setResizeKeyboard(true)
                ->setOneTimeKeyboard(true)
                ->inline()
                ->row([
                    Keyboard::inlineButton(['text' => "↪️ بازگشت", 'request_contact' => false, 'callback_data' => self::$BACK])
                ]);
            $data['reply_markup'] = $reply_markup;
        }

        (new TelegramServiceController())->send($data);
    }

    public function sendTextWithInlineBtn($text, $btns, $withBackBtn = false)
    {
        $list = [];

        foreach ($btns as $key => $value) {

            $list[] = Keyboard::inlineButton(['text' => $key, 'request_contact' => false, 'callback_data' => $value]);
        }

        if ($withBackBtn) {

            $list[] = Keyboard::inlineButton(['text' => "↪️ بازگشت", 'request_contact' => false, 'callback_data' => self::$BACK]);
        }

        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->setOneTimeKeyboard(true)
            ->inline()
            ->row($list);

        $data = [
            'chat_id' => $this->chatBot->chat_id,
            'text' => $text,
            'reply_markup' => $reply_markup
        ];

        (new TelegramServiceController())->send($data);
    }

    public function sendTextWithBtn($text, $btns, $request_contact = false)
    {
        $list = [];
        foreach ($btns as $btn) {

            $list[] = Keyboard::button(['text' => $btn, 'request_contact' => $request_contact]);
        }
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->setOneTimeKeyboard(true)
            ->row($list);

        $data = [
            'chat_id' => $this->chatBot->chat_id,
            'text' => $text,
            'reply_markup' => $reply_markup
        ];

        (new TelegramServiceController())->send($data);
    }


    public function redirectBack()
    {

        $routeMap = collect([
            ['fn' => 'startBot', 'route' => self::$START_ACTION],
            ['fn' => 'startTrade', 'route' => self::$START_TRADE_ACTION],
            ['fn' => 'needPhone', 'route' => self::$NEED_PHONE],
            ['fn' => 'needUserCheck', 'route' => self::$NEED_USER_CHECK],
            ['fn' => 'receiveTradeCoinAmount', 'route' => self::$RECIVE_COIN_AMOUNT],
            ['fn' => 'setupCoinTrade', 'route' => self::$SETUP_COIN_TRADE],
            ['fn' => 'receivePhone', 'route' => self::$RECIVE_PHONE],
            ['fn' => 'tradeType', 'route' => self::$SET_TRADE_TYPE],
            ['fn' => 'tradeAmount', 'route' => self::$SET_TRADE_AMOUNT],
        ]);

        $fn = optional($routeMap->where('route', $this->backRoute())->first())['fn'] ?? 'startBot';


        $this->{$fn}();
    }

    public function backRoute()
    {
        $action = $this->getCleanChatSession()->chatRoutes
            ->where('action', '!=', self::$BACK)
            ->where('action', '!=', self::$RECIVE_COIN_AMOUNT)
            ?->sortByDesc('id')
            ->skip(1)->first()?->action;

        $this->getCleanChatSession()->chatRoutes
            ->where('action', '!=', self::$BACK)
            ->where('action', '!=', self::$RECIVE_COIN_AMOUNT)
            ?->sortByDesc('id')
            ->take(2)->each->delete();

        return $action;
    }

    /**
     * Define an inverse one-to-one or many relationship to ChatBot.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chatBot()
    {
        return $this->belongsTo(ChatBot::class);
    }
}
