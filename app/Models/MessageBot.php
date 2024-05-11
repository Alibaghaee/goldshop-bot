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

                    if (trim($message->callback_query_text) === '/start_trade') {

                        $message->startTrade();
                    }
                    if (trim($message->callback_query_text) === '/sell' || trim($message->callback_query_text) === '/buy') {

                        $message->tradeAmount();
                    }

                    if (trim($message->callback_query_text) === '/trade_abshode' || trim($message->callback_query_text) === '/trade_coin') {

                        $message->setTradeItem();
                    }
                } else {

                    if (trim($message->text) === '/start') {

                        $message->startBot();
                    } elseif ($message->last_action === 'need_phone') {
                        if (str_contains(trim($message->text), 'contact:')) {


                            $message->receivePhone();
                        }
                    } elseif ($message->last_action === 'need_user_check') {
                        $message->receiveName();
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
        $this->setRouteAction('need_phone');

        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->setOneTimeKeyboard(true)
            ->row([
                Keyboard::button(['text' => 'به اشتراک گذاری شماره تلفن همراه', 'request_contact' => true]),
            ]);

        $data = [
            'chat_id' => $this->chatBot->chat_id,
            'text' => 'با سلام خدمت شما دوست عزیز. از طریق این بات می توانید سفارش خود را به سادگی ثبت کنید. برای بازگشت بین مراحل از دستور /back کنید. اگر آماده هستید با فشردن دکمه اشتراگ گذاری شماره همراه ادامه دهید.',
            'reply_markup' => $reply_markup,
        ];

        (new TelegramServiceController())->send($data);
    }

    public function needUserCheck()
    {
        $this->setRouteAction('need_user_check');

        $data = [
            'chat_id' => $this->chatBot->chat_id,
            'text' => "دوست عزیز شماره شما برای ثبت سفارش مجاز نشده است لطفا پس از بررسی با ادمین مجددا بررسی کنید.\nشماره ادمین سیستم:+989381807373\nایدی ادمین:@mohammadmostaviii" . "\n" . "برای دسترسی اسان تر لطفا نام خانوادگی خود را وارد کنید",
        ];

        (new TelegramServiceController())->send($data);
    }

    public function lockConversation()
    {
        $data = [
            'chat_id' => $this->chatBot->chat_id,
            'text' => 'همکار گرامی زمان معامله به پایان رسیده لطفا با شماره 09381807373 تماس حاصل نمایید',
        ];

        (new TelegramServiceController())->send($data);
    }

    public function receiveName()
    {
        $this->chatBot?->user->tryActiveMobile();

        $data = [
            'chat_id' => $this->chatBot->chat_id,
            'text' => "با تشکر بابت اطلاعات ثبت شده. مشخصات شما برای ادمین ارسال شد. منتظر تماس پشتیبانی بمانید",
        ];

        (new TelegramServiceController())->send($data);
    }

    public function receivePhone()
    {
        $this->setRouteAction('receive_phone');

        $phone = explode(':', $this->text);
        if (array_key_exists(1, $phone) && !$this->has_user) {


            $user = \App\Models\User::create(['phone' => str_replace('_98', '0', $phone[1]), 'last_chat_id' => $this->chatBot?->chat_id]);
            $this->chatBot?->user()->associate($user)->save();
        }

        $this->startBot();
    }

    public function setTradeItem()
    {


        return $this->tradeType();
    }


    public function startBot()
    {
        $this->setRouteAction('start_bot');

        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->setOneTimeKeyboard(false)
            ->inline()
            ->row([
                Keyboard::inlineButton(['text' => 'شروع معامله', 'request_contact' => false, 'callback_data' => '/start_trade']),
            ]);

        $data = [
            'chat_id' => $this->chatBot->chat_id,
            'text' => "به ربات معامله گر خوش آمدید \n پس از آمادگی دکمه شروع معامله را انتخاب کنید. ",
            'reply_markup' => $reply_markup,
        ];

        (new TelegramServiceController())->send($data);
    }

    public function startTrade()
    {
        $this->setRouteAction('start_trade');

        if (!$this->has_user) {

            return $this->needPhone();

        }

        if (!$this->valid_user) {


            return $this->needUserCheck();
        }

        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->setOneTimeKeyboard(false)
            ->inline()
            ->row([
                Keyboard::inlineButton(['text' => 'آبشده', 'request_contact' => false, 'callback_data' => '/trade_abshode']),
                Keyboard::inlineButton(['text' => 'سکه', 'request_contact' => false, 'callback_data' => '/trade_coin']),
            ]);

        $data = [
            'chat_id' => $this->chatBot->chat_id,
            'text' => 'لطفا نوع معامله را مشخص کنید',
            'reply_markup' => $reply_markup,
        ];

        (new TelegramServiceController())->send($data);
    }

    public function tradeType()
    {
        $this->setRouteAction('set_trade_type');

        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->setOneTimeKeyboard(true)
            ->inline()
            ->row([
                Keyboard::inlineButton(['text' => "فروش به ما", 'request_contact' => false, 'callback_data' => '/sell']),
                Keyboard::inlineButton(['text' => "خرید از ما", 'request_contact' => false, 'callback_data' => '/buy']),
            ]);

        $data = [
            'chat_id' => $this->chatBot->chat_id,
            'text' => 'لطفا نحوه مبادله را مشخص کنید',
            'reply_markup' => $reply_markup,
        ];

        (new TelegramServiceController())->send($data);
    }

    public function tradeAmount()
    {
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->setOneTimeKeyboard(true)
            ->row([
                Keyboard::button(['text' => "فروش به ما", 'request_contact' => false]),
                Keyboard::button(['text' => "خرید از ما", 'request_contact' => false]),
            ]);

        $data = [
            'chat_id' => $this->chatBot->chat_id,
            'text' => 'لطفا نحوه مبادله را مشخص کنید',
            'reply_markup' => $reply_markup,
        ];

        (new TelegramServiceController())->send($data);
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

            $this->chatBot?->chatSession()->associate($chatSession);

            return $this->chatBot?->chatSession;
        } else {

            return $this->chatBot?->chatSession;
        }
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
