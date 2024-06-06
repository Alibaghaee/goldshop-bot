<?php

namespace App\Repository\Telegram\UserPattern;

use App\Models\MessageBot;
use App\Models\SettingBot;
use App\Repository\Telegram\MessageBotRepoController;

class UserRepoController extends MessageBotRepoController
{


    public function __construct(MessageBot $message)
    {
        parent::__construct($message);

        if ($this->chatSessionCheck()) {


            $this->chatSessionClear();
        }
        if (!$message->from_is_bot && self::checkLockConversation()) {

            if ($message->callback_query) {
                $message->destroyMessage();
                if (trim($message->callback_query_text) === self::$START_TRADE) {

                    $this->startTrade();
                }

                if (trim($message->callback_query_text) === self::$BACK) {

                    $this->redirectBack();
                }

                if (trim($message->callback_query_text) === self::$SELL || trim($message->callback_query_text) === self::$BUY) {

                    $this->setTradeType();
                }

                if (trim($message->callback_query_text) === self::$ABSHODE || trim($message->callback_query_text) === self::$COIN) {

                    $this->setTradeItem();
                }
                if (trim($message->callback_query_text) === self::$WEIGHT || trim($message->callback_query_text) === self::$PRICE) {

                    $this->setRequireTradeAbshode();
                }

                if (trim($message->callback_query_text) === self::$CONFIRM) {
                    if ($message->last_action === self::$SETUP_COIN_TRADE) {

                        $this->endSetupCoinTrade();
                    }

                    if ($message->last_action === self::$SETUP_ABSHODE_TRADE) {

                        $this->endSetupAbshodeTrade();
                    }
                }

            } else {

                if (trim($message->text) === self::$START) {

                    $this->startBot();
                } elseif ($message->last_action === self::$NEED_PHONE) {
                    if (str_contains(trim($message->text), 'contact:')) {


                        $this->receivePhone();
                    }
                } elseif ($message->last_action === self::$NEED_USER_CHECK) {
                    $this->receiveName();
                } elseif ($message->last_action === self::$SET_TRADE_AMOUNT && $message->session_item === self::$COIN) {
                    if ($this->validUnsignedFloatAndInt($this->message->text)) {

                        $this->receiveTradeCoinAmount();
                    }
                } elseif (($message->last_action === self::$REQUIRE_TRADE_ABSHODE_WEIGHT || $message->last_action === self::$REQUIRE_TRADE_ABSHODE_PRICE) && $message->session_item === self::$ABSHODE) {
                    if ($this->validUnsignedFloatAndInt($this->message->text)) {

                        $this->receiveRequireTradeAbshode();
                    }
                }
            }


        } else {

            $this->lockConversation();
        }

    }

    public static function checkLockConversation()
    {

        return true;
    }


    public function endSetupAbshodeTrade(): void
    {

        if ($this->message->session_type === self::$SELL) {
            $abshodeFactor = (float)$this->getFactorPrice("buying_gram");

        } else {

            $abshodeFactor = (float)$this->getFactorPrice("selling_gram");
        }

        if ($abshodeFactor !== $this->message->session_factor) {
            $this->chatSessionClear();
            $this->message->sendTextWithInlineBtn("قیمت ها به روزرسانی شده اند لطفا دوباره تلاش کنید", ["شروع مجدد" => self::$START_TRADE]);
            return;
        }

        $abshodeBalance = $this->settingBot()->abshode_balance;

        if ($this->message->session_type === self::$SELL) {

            $abshodeBalance += $this->message->session_weight;
        } else {
            $abshodeBalance -= $this->message->session_weight;
        }
        $this->settingBot()->setAbshodeBalance($abshodeBalance);


        $this->submitOrder();
        $this->chatSessionClear();
        $this->message->sendAloneText("معاملات شما با موفقیت انجام شد. از حسن اعتماد شما متشکریم. منتظر تماس پشتیبانی باشید.");
        return;
    }

    public function setupAbshodeTrade(): void
    {
        if ($this->message->session_unit === self::$WEIGHT) {

            if ($this->message->session_type === self::$SELL) {

                $gramFactor = $this->getFactorPrice('buying_gram');
                $abshodeFactor = $this->getFactorPrice('buying_abshode');

            } else {


                $gramFactor = $this->getFactorPrice('selling_gram');
                $abshodeFactor = $this->getFactorPrice('selling_abshode');
            }


            $this->message->setPrice((float)$gramFactor * (float)$this->message->session_weight);
        } elseif ($this->message->session_unit === self::$PRICE) {


            if ($this->message->session_type === self::$SELL) {

                $gramFactor = $this->getFactorPrice('buying_gram');
                $abshodeFactor = $this->getFactorPrice('buying_abshode');

            } else {


                $gramFactor = $this->getFactorPrice('selling_gram');
                $abshodeFactor = $this->getFactorPrice('selling_abshode');
            }

            $this->message->setWeight((float)$this->message->session_price / ((float)$gramFactor * 1000));
        } else {


            $this->message->sendAloneText('وزن یا مبلغ یافت نشد!!!');

            $this->redirectBack();
            return;

        }

        $this->message->setRouteAction(self::$SETUP_ABSHODE_TRADE);
        $this->message->setFactor($gramFactor);

        /////


        $lable = $this->message->session_type === self::$SELL ? "🔵" : "🔴";
        $time = time_fa($this->message->created_at);
        $text = "نوع خرید: {$this->message->session_item_fa}\nعملیات مورد نظر: {$this->message->session_type_fa}\nوزن: {$this->message->session_weight}\nقیمت {$this->message->session_type_fa} هر گرم: $gramFactor $lable\nقیمت {$this->message->session_type_fa} آبشده: {$abshodeFactor} $lable\nقیمت کل: {$this->message->session_price}\nشماره مشتری: +{$this->message->chatBot?->user?->mobile}\nنام و نام خانوادگی مشتری: {$this->message->chatBot?->user?->name}\nتاریخ معامله: $time";

        $this->message->sendTextWithInlineBtn($text, ["بله تایید میکنم" => self::$CONFIRM], true);

    }

    public function receiveRequireTradeAbshode(): void
    {

        $this->message->setRouteAction(self::$RECEIVE_REQUIRE_TRADE_ABSHODE);


        if ($this->message->last_action === self::$REQUIRE_TRADE_ABSHODE_WEIGHT) {

            $this->message->setUnit(self::$WEIGHT);
            $this->message->setWeight(to_english_numbers($this->message->text));
            $text = 'وزن مورد نظر با موفقیت دریافت شد';
        } else {
            $this->message->setUnit(self::$PRICE);
            $this->message->setPrice(to_english_numbers($this->message->text));
            $text = 'مبلغ مورد نظر با موفقیت دریافت شد';
        }
        $this->message->sendAloneText($text);

        $this->setupAbshodeTrade();
    }


    public function setRequireTradeAbshode(): void
    {


        if (trim($this->message->callback_query_text) === self::$WEIGHT) {

            $this->message->setRouteAction(self::$REQUIRE_TRADE_ABSHODE_WEIGHT);

            $text = "لطفا وزن مورد نظر را وارد نمایید\n👇👇👇";
        } else {
            $this->message->setRouteAction(self::$REQUIRE_TRADE_ABSHODE_PRICE);
            $text = "لطفا مبلغ مورد نظر را وارد نمایید\n👇👇👇";
        }

        $this->message->sendAloneText($text, true);
    }


    public function needPhone(): void
    {
        $this->message->setRouteAction(self::$NEED_PHONE);


        $this->message->sendTextWithBtn(
            'با سلام خدمت شما دوست عزیز. از طریق این بات می توانید سفارش خود را به سادگی ثبت کنید. برای بازگشت بین مراحل از دستور <<↪️ بازگشت>> کنید. اگر آماده هستید با فشردن دکمه اشتراگ گذاری شماره همراه ادامه دهید.',
            ['به اشتراک گذاری شماره تلفن همراه'],
            true
        );


    }

    public function needUserCheck(): void
    {
        $this->message->setRouteAction(self::$NEED_USER_CHECK);


        $this->message->sendAloneText(
            "دوست عزیز شماره شما برای ثبت سفارش مجاز نشده است لطفا پس از بررسی با ادمین مجددا بررسی کنید.\nشماره ادمین سیستم:+989381807373\nایدی ادمین:@mohammadmostaviii" . "\n" . "برای دسترسی اسان تر لطفا نام خانوادگی خود را وارد کنید",
            true);
    }

    public function lockConversation(): void
    {
        $this->message->sendAloneText('همکار گرامی زمان معامله به پایان رسیده لطفا با شماره 09381807373 تماس حاصل نمایید');

    }

    public function receiveName(): void
    {
        $this->message->chatBot?->user->tryActiveMobile();
        $this->message->sendAloneText("با تشکر بابت اطلاعات ثبت شده. مشخصات شما برای ادمین ارسال شد. منتظر تماس پشتیبانی بمانید", true);


    }

    public function receiveTradeCoinAmount(): void
    {

        $text = (int)to_english_numbers($this->message->text);


        if ($text === 0) {

            $this->message->sendAloneText("تعداد وارده معتبر نیست. لطفا دوباره تلاش کنید ...", true);
            return;
        }

        $this->message->setRouteAction(self::$RECIVE_COIN_AMOUNT);

        if ($this->message->session_item === self::$COIN) {

            $this->message->setCoinAmount($text);

            $this->setupCoinTrade();
            return;
        }
    }

    public function setupCoinTrade(): void
    {
        $this->message->setRouteAction(self::$SETUP_COIN_TRADE);

        if ($this->message->session_type === self::$SELL) {
            $coinFactor = (float)$this->getFactorPrice("buying_coin");

        } else {

            $coinFactor = (float)$this->getFactorPrice("selling_coin");
        }

        $count = (int)$this->message->session_coin_amount;
        $totalPrice = $count * $coinFactor;
        $this->message->setTotalInvoice($totalPrice);
        $this->message->setFactor($coinFactor);

        $lable = $this->message->session_type === self::$SELL ? "🔵" : "🔴";
        $time = time_fa($this->message->created_at);
        $text = "نوع خرید: {$this->message->session_item_fa}\nعملیات مورد نظر: {$this->message->session_type_fa}\nتعداد: {$this->message->session_coin_amount}\nقیمت {$this->message->session_type_fa} هر سکه امامی: $coinFactor  $lable \nقیمت کل: $totalPrice \nشماره مشتری: +{$this->message->chatBot?->user?->mobile}\nنام و نام خانوادگی مشتری: {$this->message->chatBot?->user?->name}\nتاریخ معامله: $time";


        $this->message->sendTextWithInlineBtn($text, ["بله تایید میکنم" => self::$CONFIRM], true);


    }

    public function endSetupCoinTrade(): void
    {
        if ($this->message->session_type === self::$SELL) {
            $coinFactor = (float)$this->getFactorPrice("buying_coin");

        } else {

            $coinFactor = (float)$this->getFactorPrice("selling_coin");
        }

        if ($coinFactor !== $this->message->session_factor) {
            $this->chatSessionClear();
            $this->message->sendTextWithInlineBtn("قیمت ها به روزرسانی شده اند لطفا دوباره تلاش کنید", ["شروع مجدد" => self::$START_TRADE]);
            return;
        }

        $coinBalance = $this->settingBot()->coin_balance;

        if ($this->message->session_type === self::$SELL) {

            $coinBalance += $this->message->session_coin_amount;
        } else {
            $coinBalance -= $this->message->session_coin_amount;
        }
        $this->settingBot()->setCoinBalance($coinBalance);

        $this->submitOrder();
        $this->chatSessionClear();
        $this->message->sendAloneText("معاملات شما با موفقیت انجام شد. از حسن اعتماد شما متشکریم. منتظر تماس پشتیبانی باشید.");
        return;
    }


    public function receivePhone(): void
    {
        $this->message->setRouteAction(self::$RECIVE_PHONE);

        $phone = explode(':', $this->message->text);
        if (array_key_exists(1, $phone) && !$this->message->has_user) {

            $user = \App\Models\User::create(['mobile' => str_replace('_98', '0', $phone[1]), 'last_chat_id' => $this->message->chatBot?->chat_id]);
            $this->message->chatBot?->user()->associate($user)->save();
        }

        $this->startBot();
    }

    public function setTradeItem(): void
    {

        $this->message->setItem(trim($this->message->callback_query_text));

        $this->tradeType();
    }

    public function setTradeType(): void
    {

        $this->message->setType(trim($this->message->callback_query_text));

        $this->tradeAmount();
    }


    public function startBot(): void
    {
        $this->message->setRouteAction(self::$START_ACTION);
        $this->message->setStartBot(true);


        $this->message->sendTextWithInlineBtn("به ربات معامله گر خوش آمدید \n پس از آمادگی دکمه شروع معامله را انتخاب کنید. ", ['شروع معامله' => self::$START_TRADE]);


    }

    public function startTrade(): void
    {
        $this->message->setRouteAction(self::$START_TRADE_ACTION);

        $this->message->sendTextWithBtn('شروع', [self::$START]);

        if (!$this->message->has_user) {

            $this->needPhone();
            return;
        }

        if (!$this->message->valid_user) {


            $this->needUserCheck();
            return;
        }

        $this->message->setStartTrade(true);

        $this->chatSessionClear();

        $this->message->sendTextWithInlineBtn('لطفا نوع معامله را مشخص کنید', ["آبشده" => self::$ABSHODE, 'سکه' => self::$COIN], true);
    }

    public function tradeType(): void
    {
        $this->message->setRouteAction(self::$SET_TRADE_TYPE);

        $this->message->sendTextWithInlineBtn('لطفا نحوه مبادله را مشخص کنید', ["فروش به ما" => self::$SELL, "خرید از ما" => self::$BUY], true);
    }

    public function tradeAmount(): void
    {
        $this->message->setRouteAction(self::$SET_TRADE_AMOUNT);


        if ($this->message->session_item === self::$COIN) {
            if ($this->message->session_type === self::$SELL) {
                $text = "قیمت فروش هر سکه امامی: " . $this->message->getCoinPrice(self::$SELL) . "🔵";

            } else {
                $text = "قیمت خرید هر سکه امامی: " . $this->message->getCoinPrice(self::$BUY) . "🔴";
            }
            $text = $text . "\n" . "لطفا تعداد سکه را وارد نمایید\n👇👇👇";

            $this->message->sendAloneText($text, true);

        } else {


            $this->message->sendTextWithInlineBtn("لطفا واحد عملیات مبادله را مشخص کنید.", ["وزن" => self::$WEIGHT, "مبلغ" => self::$PRICE], true);
        }
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
        $action = $this->message->getCleanChatSession()->chatRoutes
            ->where('action', '!=', self::$BACK)
            ->where('action', '!=', self::$RECIVE_COIN_AMOUNT)
            ->where('action', '!=', self::$RECEIVE_REQUIRE_TRADE_ABSHODE)
            ?->sortByDesc('id')
            ->skip(1)->first()?->action;

        $this->message->getCleanChatSession()->chatRoutes
            ->where('action', '!=', self::$BACK)
            ->where('action', '!=', self::$RECIVE_COIN_AMOUNT)
            ->where('action', '!=', self::$RECEIVE_REQUIRE_TRADE_ABSHODE)
            ?->sortByDesc('id')
            ->take(2)->each->delete();

        return $action;
    }

    public function validUnsignedFloatAndInt($value): bool
    {

        if (is_null($value) || !self::hasUnsignedFloatAndInt(to_english_numbers($value))) {

            $this->message->sendAloneText('فرمت ورودی اشتباه است!!!');

            $this->redirectBack();
            return false;
        }
        return true;
    }

    private function submitOrder()
    {

        $data = [];
        $data['user_id'] = $this->message->chatBot?->user->id;
        $data['type'] = $this->message->session_type;
        $data['item'] = $this->message->session_item;
        $data['price'] = $this->message->session_price;
        $data['weight'] = $this->message->session_weight;
        $data['count'] = $this->message->session_coin_amount;

        self::createOrder($data);
    }


    private function settingBot()
    {
        return SettingBot::where('bot_tag', SettingBot::$MMD_TALA)->firstOrCreate(['bot_tag' => SettingBot::$MMD_TALA]);
    }

    public function getFactorPrice(string $type)
    {

        return $this->settingBot()->main[$type];
    }
}
