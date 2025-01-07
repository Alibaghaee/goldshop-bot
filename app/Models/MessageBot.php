<?php

namespace App\Models;

use App\Repository\Telegram\ManagerPattern\ManagerRepoController;
use App\Repository\Telegram\PriceAbshodeManagerPattern\PriceAbshodeManagerRepoController;
use App\Repository\Telegram\PriceCoinManagerPattern\PriceCoinManagerRepoController;
use App\Repository\Telegram\PriceManagerPattern\PriceManagerRepoController;
use App\Repository\Telegram\UserPattern\UserRepoController;
use App\Service\TellBot\TelegramServiceController;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Telegram\Bot\FileUpload\InputFile;
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
        'bot_role',
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

    public static $SETUP_ABSHODE_TRADE = 'setup_abshode_trade';

    public static $RECIVE_PHONE = 'receive_phone';

    public static $SET_TRADE_TYPE = 'set_trade_type';

    public static $START_TRADE_ACTION = 'start_trade';

    public static $START_ACTION = 'start_bot';


    public static $REQUIRE_TRADE_ABSHODE_WEIGHT = 'require_trade_abshode_weight';

    public static $REQUIRE_TRADE_ABSHODE_PRICE = 'require_trade_abshode_price';

    public static $RECEIVE_REQUIRE_TRADE_ABSHODE = 'receive_require_trade_abshode';

    public static $BACK = '/back';

    public static $SELL_US_ORDER = 'sell_us_order';

    public static $BUY_FROM_US_ORDER = 'buy_from_us_order';

    public static $MANUAL_ORDER_SUBMISSION = 'manual_order_submission';


    public static $MANAGER = 'manager';
    public static $PRICE_MANAGER = 'price_manager';

    public static $PRICE_ABSHODE_MANAGER = 'price_abshode_manager';

    public static $PRICE_COIN_MANAGER = 'price_coin_manager';

    public static $USER = 'user';

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function (MessageBot $message) {

            if ($message->is_manager) {

                new ManagerRepoController($message);
            } elseif ($message->is_price_manager) {

                new PriceManagerRepoController($message);
            } elseif ($message->is_price_abshode_manager) {

                new PriceAbshodeManagerRepoController($message);
            } elseif ($message->is_price_coin_manager) {

                new PriceCoinManagerRepoController($message);
            } elseif ($message->is_user) {

                new UserRepoController($message);
            }
        });
    }


    public static function userRole(MessageBot $message)
    {
        if ($message->is_manager) {

            $role = 'manager';
        } elseif ($message->is_price_manager) {

            $role = 'price_manager';
        } elseif ($message->is_price_abshode_manager) {

            $role = 'price_abshode_manager';
        }  elseif ($message->is_price_coin_manager) {

            $role = 'price_coin_manager';
        } else {

            $role = 'user';
        }
        return $role;
    }

    public static function telegramBot($USER_ROLE)
    {

        return (new TelegramServiceController($USER_ROLE));
    }

    public static function managerIds()
    {
        return [
            ['id' => '995540520'],
            ['id' => '7303273877'],
            ['id' => '467920433'],
        ];
    }

    public static function priceManagerIds()
    {
        return [
            ['id' => '995540520'],
            ['id' => '7303273877'],
            ['id' => '467920433'],
        ];
    }

    public static function priceAbshodeManagerIds()
    {
        return [
            ['id' => '995540520'],
            ['id' => '7303273877'],
            ['id' => '467920433'],
        ];
    }

    public static function priceCoinManagerIds()
    {
        return [
            ['id' => '995540520'],
            ['id' => '7303273877'],
            ['id' => '467920433'],
        ];
    }

    public function getIsManagerAttribute()
    {

        return collect(self::managerIds())->where('id', $this->chatBot?->chat_id)->isNotEmpty() && ($this->bot_role === self::$MANAGER);
    }

    public function getIsPriceManagerAttribute()
    {

        return collect(self::priceManagerIds())->where('id', $this->chatBot?->chat_id)->isNotEmpty() && ($this->bot_role === self::$PRICE_MANAGER);
    }

    public function getIsPriceAbshodeManagerAttribute()
    {

        return collect(self::priceAbshodeManagerIds())->where('id', $this->chatBot?->chat_id)->isNotEmpty() && ($this->bot_role === self::$PRICE_ABSHODE_MANAGER);
    }

    public function getIsPriceCoinManagerAttribute()
    {

        return collect(self::priceCoinManagerIds())->where('id', $this->chatBot?->chat_id)->isNotEmpty() && ($this->bot_role === self::$PRICE_COIN_MANAGER);
    }

    public function getIsUserAttribute()
    {

        return $this->bot_role === self::$USER;
    }

    public function setRouteAction(string $value)
    {

        $this->getCleanChatSession()?->chatRoutes()->create(['action' => $value])->save();
    }

    public function chatSessionClear()
    {


        $this->chatBot?->chatSession?->delete();
    }

    public function chatSessionCheck()
    {
        return $this->chatBot?->chatSession?->updated_at <= now()->subHour();
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

    public function getGramPrice(string $type)
    {
        return '1000000';
    }

    public function getAbshode(string $type)
    {
        return '1000000';
    }

    public function getTotalCoinPrice(string $type)
    {
        return $this->getCoinPrice($type) * $this->session_coin_amount;
    }

    public function getTotalAbshode(string $type)
    {
        return (int)$this->getAbshode($type) * (int)$this->session_price;
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


    public function getHasChatSessionAttribute()
    {
        return $this->chatBot?->chatSession()->exists();
    }


    public function setItem(string $value)
    {

        $this->getCleanChatSession()->setItem($value);
    }

    public function getSessionItemAttribute()
    {

        return $this->getCleanChatSession()->item;
    }

    public function setFactor(string $value)
    {

        $this->getCleanChatSession()->setFactor($value);
    }

    public function getSessionFactorAttribute()
    {

        return $this->getCleanChatSession()->factor;
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

    public function setCoinAmountManualOrder(string $value)
    {

        $this->getCleanChatSession()->setCoinAmountManualOrder($value);
    }

    public function getSessionCoinAmountManualOrderAttribute()
    {

        return $this->getCleanChatSession()->coin_amount_manual_order;
    }

    public function setTotalInvoice(string $value)
    {

        $this->getCleanChatSession()->setTotalInvoice($value);
    }

    public function getSessionTotalInvoiceAttribute()
    {

        return $this->getCleanChatSession()->total_invoice;
    }

    public function setTotalInvoiceManualOrder(string $value)
    {

        $this->getCleanChatSession()->setTotalInvoiceManualOrder($value);
    }

    public function getSessionTotalInvoiceManualOrderAttribute()
    {

        return $this->getCleanChatSession()->total_invoice_manual_order;
    }


    public function setWeight(string $value)
    {

        $this->getCleanChatSession()->setWeight($value);
    }

    public function getSessionWeightAttribute()
    {

        return $this->getCleanChatSession()->weight;
    }

    public function setPrice(string $value)
    {

        $this->getCleanChatSession()->setPrice($value);
    }

    public function getSessionPriceAttribute()
    {

        return $this->getCleanChatSession()->price;
    }

    public function setUnit(string $value)
    {

        $this->getCleanChatSession()->setUnit($value);
    }

    public function getSessionUnitAttribute()
    {

        return $this->getCleanChatSession()->unit;
    }


    public function setUnitManualOrder(string $value)
    {

        $this->getCleanChatSession()->setUnitManualOrder($value);
    }

    public function getSessionUnitManualOrderAttribute()
    {

        return $this->getCleanChatSession()->unit_manual_order;
    }

    public function setUserMobile(string $value)
    {

        $this->getCleanChatSession()->setUserMobile($value);
    }

    public function getSessionUserMobileAttribute()
    {

        return $this->getCleanChatSession()->user_mobile;
    }

    public function setMarginType(string $value)
    {

        $this->getCleanChatSession()->setMarginType($value);
    }

    public function getSessionMarginTypeAttribute()
    {

        return $this->getCleanChatSession()->margin_type;
    }

    public function setBalanceType(string $value)
    {

        $this->getCleanChatSession()->setBalanceType($value);
    }

    public function getSessionBalanceTypeAttribute()
    {

        return $this->getCleanChatSession()->balance_type;
    }

    public function setStartManualOrder(bool $value)
    {

        $this->getCleanChatSession()->setStartManualOrder($value);
    }

    public function getSessionStartManualOrderAttribute()
    {

        return $this->getCleanChatSession()->start_manual_order;
    }

    public function setUserIdManualOrder(int $value)
    {

        $this->getCleanChatSession()->setUserIdManualOrder($value);
    }

    public function getSessionUserIdManualOrderAttribute()
    {

        return $this->getCleanChatSession()->user_id_manual_order;
    }

    public function setItemManualOrder(string $value)
    {

        $this->getCleanChatSession()->setItemManualOrder($value);
    }

    public function getSessionItemManualOrderAttribute()
    {

        return $this->getCleanChatSession()->item_manual_order;
    }

    public function getSessionItemManualOrderFaAttribute()
    {

        return $this->session_item_manual_order === self::$MANUAL_ORDER_SUBMISSION . '_' . self::$COIN ? 'سکه' : 'آبشده';
    }

    public function setTypeManualOrder(string $value)
    {

        $this->getCleanChatSession()->setTypeManualOrder($value);
    }

    public function getSessionTypeManualOrderAttribute()
    {

        return $this->getCleanChatSession()->type_manual_order;
    }

    public function getSessionTypeManualOrderFaAttribute()
    {

        return $this->session_type_manual_order === self::$SELL_US_ORDER ? 'فروش' : 'خرید';
    }

    public function setPriceManualOrder(float $value)
    {

        $this->getCleanChatSession()->setPriceManualOrder($value);
    }

    public function getSessionPriceManualOrderAttribute()
    {

        return $this->getCleanChatSession()->price_manual_order;
    }

    public function setAbshodeWeightManualOrder(float $value)
    {

        $this->getCleanChatSession()->setAbshodeWeightManualOrder($value);
    }

    public function getSessionAbshodeWeightManualOrderAttribute()
    {

        return $this->getCleanChatSession()->abshode_weight_manual_order;
    }

    public function setAbshodePriceManualOrder(float $value)
    {

        $this->getCleanChatSession()->setAbshodePriceManualOrder($value);
    }

    public function getSessionAbshodePriceManualOrderAttribute()
    {

        return $this->getCleanChatSession()->abshode_price_manual_order;
    }


    public function destroyMessage()
    {
        self::telegramBot(self::userRole($this))->deleteMessage($this->chatBot->chat_id, $this->message_id);
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

        self::telegramBot(self::userRole($this))->send($data);
    }

    public function sendTextWithInlineBtn($text, $btns, $withBackBtn = false, $rowList = false)
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
            ->inline();
        if ($rowList) {
            foreach ($list as $item) {

                $reply_markup->row([$item]);
            }
        } else {

            $reply_markup->row($list);
        }

        $data = [
            'chat_id' => $this->chatBot->chat_id,
            'text' => $text,
            'reply_markup' => $reply_markup
        ];

        self::telegramBot(self::userRole($this))->send($data);
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

        self::telegramBot(self::userRole($this))->send($data);
    }

    public function sendCustomChatTextWithBtnUrl($chatId, $text, $btns, $rowList = false)
    {
        $list = [];
        foreach ($btns as $key => $value) {

            $list[] = Keyboard::inlineButton(['text' => $key, 'request_contact' => false, 'url' => $value]);
        }
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->setOneTimeKeyboard(true)
            ->inline();

        if ($rowList) {
            foreach ($list as $item) {

                $reply_markup->row([$item]);
            }
        } else {

            $reply_markup->row($list);
        }
        $data = [
            'chat_id' => $chatId,
            'text' => $text,
            'reply_markup' => $reply_markup
        ];

        self::telegramBot(self::userRole($this))->send($data);
    }

    public function sendCustomChatTextWithBtn($chatId, $text, $btns, $rowList = false, $role = null)
    {
        $list = [];
        foreach ($btns as $key => $value) {

            $list[] = Keyboard::inlineButton(['text' => $key, 'request_contact' => false, 'callback_data' => $value]);
        }
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->setOneTimeKeyboard(true)
            ->inline();

        if ($rowList) {
            foreach ($list as $item) {

                $reply_markup->row([$item]);
            }
        } else {

            $reply_markup->row($list);
        }
        $data = [
            'chat_id' => $chatId,
            'text' => $text,
            'reply_markup' => $reply_markup
        ];

        if (is_null($role)) {

            $role = self::userRole($this);
        }

        self::telegramBot($role)->send($data);
    }

    public function sendCustomChatAloneText($chatId, $text)
    {

        $data = [
            'chat_id' => $chatId,
            'text' => $text,
        ];

        self::telegramBot(self::userRole($this))->send($data);
    }

    public static function sendGlobalCustomChatAloneText($chatId, $text, $botRole)
    {

        $data = [
            'chat_id' => $chatId,
            'text' => $text,
        ];

        self::telegramBot($botRole)->send($data);
    }

    public function sendDocument($file, $caption = '', $fileName = '')
    {

        $data = [
            'chat_id' => $this->chatBot->chat_id,
            'document' => InputFile::create(asset($file), $fileName),
            'caption' => $caption,
        ];


        self::telegramBot(self::userRole($this))->sendDocument($data);
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
