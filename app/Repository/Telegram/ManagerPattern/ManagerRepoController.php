<?php

namespace App\Repository\Telegram\ManagerPattern;

use App\Exports\OrdersExport;
use App\Models\MessageBot;
use App\Models\OrderBot;
use App\Models\SettingBot;
use App\Models\User;
use App\Repository\Telegram\MessageBotRepoController;

class ManagerRepoController extends MessageBotRepoController
{


    public function __construct(MessageBot $message)
    {
        parent::__construct($message);

        if ($this->chatSessionCheck()) {


            $this->chatSessionClear();
        }
        if (!$message->from_is_bot) {

            if ($message->callback_query) {
                $message->destroyMessage();
                if (trim($message->callback_query_text) === self::$BACK) {

                    $this->redirectBack();
                }
                if (trim($message->callback_query_text) === self::$CHANGE_LOCK) {

                    $this->changeLockTime();
                }

                if (trim($message->callback_query_text) === self::$CHANGE_START_LOCK) {

                    $this->changeStartLockTime();
                }
                if (trim($message->callback_query_text) === self::$CHANGE_STOP_LOCK) {

                    $this->changeStopLockTime();
                }
                if (trim($message->callback_query_text) === self::$ADD_USER) {

                    $this->addUser();
                }

                if (trim($message->callback_query_text) === self::$CHANGE_MARGIN) {

                    $this->changeMargin();
                }
                if (trim($message->callback_query_text) === self::$CHANGE_BALANCE) {

                    $this->changeBalance();
                }

                if (trim($message->callback_query_text) === self::$ABSHODE_MARGIN || trim($message->callback_query_text) === self::$COIN_MARGIN) {

                    $this->setMargin();
                }
                if (trim($message->callback_query_text) === self::$ABSHODE_BALANCE || trim($message->callback_query_text) === self::$COIN_BALANCE) {

                    $this->setBalance();
                }
                if (trim($message->callback_query_text) === self::$REMOVE_USER) {

                    $this->deleteUser();
                }
                if ($message->last_action === self::$DELETE_USER && str_contains(trim($message->callback_query_text), 'delete:')) {


                    $this->receiveDeleteUser();
                }
                if ($message->last_action === self::$RECIVE_MANUAL_ORDER_USER && str_contains(trim($message->callback_query_text), self::$MANUAL_ORDER_SUBMISSION . ':')) {


                    $this->receiveUserAndStartManualOrder();
                }
                if (trim($message->callback_query_text) === self::$MANUAL_ORDER_SUBMISSION) {

                    $this->startManualOrder();
                }
                if ($message->last_action === self::$RECIVE_AND_START_MANUAL_ORDER_USER && (trim($message->callback_query_text) === self::$MANUAL_ORDER_SUBMISSION . '_' . self::$ABSHODE || trim($message->callback_query_text) === self::$MANUAL_ORDER_SUBMISSION . '_' . self::$COIN)) {

                    $this->receiveOrderItem();
                }
                if ($message->last_action === self::$RECEIVE_ORDER_PRICE && (trim($message->callback_query_text) === self::$SELL_US_ORDER || trim($message->callback_query_text) === self::$BUY_FROM_US_ORDER)) {

                    $this->receiveTypeAndSelectOrderType();
                }
                if ($message->last_action === self::$MANUAL_ORDER_SUBMISSION . '_' . self::$SETUP_COIN_TRADE && trim($message->callback_query_text) === self::$MANUAL_ORDER_SUBMISSION . '_' . self::$CONFIRM) {

                    $this->endSetupCoinManualOrder();
                }
                if ($message->last_action === self::$MANUAL_ORDER_SUBMISSION . '_' . self::$SETUP_ABSHODE_TRADE && trim($message->callback_query_text) === self::$MANUAL_ORDER_SUBMISSION . '_' . self::$CONFIRM) {

                    $this->endSetupAbshodeOrder();
                }
                if ($message->last_action === self::$RECEIVE_ORDER_TYPE && (trim($message->callback_query_text) === self::$MANUAL_ORDER_SUBMISSION . '_' . self::$WEIGHT || trim($message->callback_query_text) === self::$MANUAL_ORDER_SUBMISSION . '_' . self::$PRICE)) {

                    $this->setRequireOrderAbshode();
                }

                if (trim($message->callback_query_text) === self::$REPORT) {

                    $this->reportOrders();
                }

            } else {

                if (trim($message->text) === self::$START) {

                    $this->startBot();
                } elseif ($message->last_action === self::$CHANGE_START_LOCK) {

                    $this->receiveStartLockTime();
                } elseif ($message->last_action === self::$CHANGE_STOP_LOCK) {

                    $this->receiveStopLockTime();
                } elseif ($message->last_action === self::$ADD_USER) {

                    $this->receiveUserMobile();
                } elseif ($message->last_action === self::$ADD_USER_MOBILE) {

                    $this->receiveUserName();
                } elseif ($message->last_action === self::$SET_MARGIN) {

                    $this->receiveMargin();
                } elseif ($message->last_action === self::$SET_BALANCE) {
                    if ($this->validUnsignedFloatAndInt($this->message->text)) {

                        $this->receiveBalance();
                    }
                } elseif ($message->last_action === self::$START_MANUAL_ORDER) {

                    $this->receiveManualOrderUser();
                } elseif ($message->last_action === self::$RECEIVE_ORDER_ITEM) {
                    if ($this->validUnsignedFloatAndInt($this->message->text)) {

                        $this->receivePriceAndSelectOrderType();
                    }
                } elseif ($message->last_action === self::$RECEIVE_ORDER_TYPE) {
                    if ($this->validUnsignedFloatAndInt($this->message->text)) {

                        $this->receiveManualOrderCoinAmount();
                    }
                } elseif (($message->last_action === self::$MANUAL_ORDER_SUBMISSION . '_' . self::$REQUIRE_TRADE_ABSHODE_WEIGHT || $message->last_action === self::$MANUAL_ORDER_SUBMISSION . '_' . self::$REQUIRE_TRADE_ABSHODE_PRICE) && $message->session_item_manual_order === self::$MANUAL_ORDER_SUBMISSION . '_' . self::$ABSHODE) {
                    if ($this->validUnsignedFloatAndInt($this->message->text)) {

                        $this->receiveRequireOrderAbshode();
                    }
                }
            }


        }


    }


    public function startBot()
    {
        $this->message->setRouteAction(self::$START_ACTION);
        $this->message->setStartBot(true);

        $this->message->sendTextWithBtn('شروع', [self::$START]);

        $btns = [
            'تغییر زمان قفل' => self::$CHANGE_LOCK,
            'اضافه کردن کاربر' => self::$ADD_USER,
            'تغییر مارجین' => self::$CHANGE_MARGIN,
            'حذف کاربر' => self::$REMOVE_USER,
            'تغییر تراز' => self::$CHANGE_BALANCE,
            'ثبت سفارش دستی' => self::$MANUAL_ORDER_SUBMISSION,
            'گزارش سفارشات' => self::$REPORT,
        ];
        $this->message->sendTextWithInlineBtn("لطفا عملیات مورد نظر را انتخاب کنید", $btns, false, true);


    }

    public function changeLockTime()
    {
        $this->message->setRouteAction(self::$CHANGE_LOCK);


        $btns = [
            'تغییر ساعت شروع قفل' => self::$CHANGE_START_LOCK,
            'تغییر ساعت پایان قفل' => self::$CHANGE_STOP_LOCK,
        ];
        $this->message->sendTextWithInlineBtn("برای تنظیم قفل زمانی معاملات لطفا عملیات مورد نظر را انتخاب کنید", $btns, true, true);
    }


    public function changeStartLockTime()
    {
        $this->message->setRouteAction(self::$CHANGE_START_LOCK);


        $this->message->sendAloneText("ساعت شروع کار ربات را تعیین کنید\nفرمت ورودی باید به این صورت باشد(11:30)", true);
    }


    public function receiveStartLockTime()
    {
        $text = explode(':', $this->message->text);
        if (array_key_exists(1, $text)) {
            $text[0] = (int)to_english_numbers($text[0]);
            $text[1] = (int)to_english_numbers($text[1]);

            $text = implode(':', $text);

            if (!preg_match('/^([01][0-9]|2[0-3]):([0-5][0-9])$/', $text)) {
                $this->message->sendAloneText("فرمت ورودی اشتباه است!!!");
            } else {

                $setting = $this->settingBot();
                $setting->setStartLockTime($text);

                $this->message->setRouteAction(self::$RECEIVE_START_LOCK_TIME);


                $this->message->sendAloneText("ساعت شروع کار ربات با موفقیت دریافت شد.");

                $this->redirectBack();
            }

        } else {
            $this->message->sendAloneText("فرمت ورودی اشتباه است!!!");
            $this->redirectBack();
        }
    }

    public function changeStopLockTime()
    {
        $this->message->setRouteAction(self::$CHANGE_STOP_LOCK);


        $this->message->sendAloneText("ساعت پایان کار ربات را تعیین کنید.\nفرمت ورودی باید به این صورت باشد(21:30)", true);
    }


    public function receiveStopLockTime()
    {
        $text = explode(':', $this->message->text);
        if (array_key_exists(1, $text)) {
            $text[0] = to_english_numbers($text[0]);
            $text[1] = to_english_numbers($text[1]);

            $text = implode(':', $text);

            if (!preg_match('/^([01][0-9]|2[0-3]):([0-5][0-9])$/', $text)) {
                $this->message->sendAloneText("فرمت ورودی اشتباه است!!!");
            } else {


                $this->message->setRouteAction(self::$RECEIVE_STOP_LOCK_TIME);

                $setting = $this->settingBot();
                $setting->setStopLockTime($text);

                $this->message->sendAloneText("ساعت پایان کار ربات با موفقیت دریافت شد.");

                $this->redirectBack();
            }

        } else {
            $this->message->sendAloneText("فرمت ورودی اشتباه است!!!");
            $this->redirectBack();
        }
    }


    public function addUser()
    {
        $this->message->setRouteAction(self::$ADD_USER);

        $this->message->sendAloneText("شماره همراه کاربر را وارد کنید\n09XXXXXXXXX", true);

    }

    public function receiveUserMobile()
    {
        $this->message->setRouteAction(self::$ADD_USER_MOBILE);

        if (preg_match('/^09\d{9}$/', to_english_numbers($this->message->text))) {

            $this->message->setUserMobile(to_english_numbers($this->message->text));
            $this->message->sendAloneText("شماره همراه کاربر با موفقیت دریافت شد\nنام کامل کاربر را وارد کنید", true);
        } else {

            $this->message->sendAloneText("فرمت ورودی اشتباه است!!!");
            $this->redirectBack();
        }
    }

    public function receiveUserName()
    {
        if (!is_null($this->message->session_user_mobile)) {

            if (User::where('mobile', $this->message->session_user_mobile)->first()) {

                $this->message->sendAloneText("شماره موبایل تکراری است!!!");

                $this->redirectBack();
            } else {
                $this->message->setRouteAction(self::$ADD_USER_NAME);

                User::create(['mobile' => $this->message->session_user_mobile, 'name' => $this->message->text]);


                $this->message->sendAloneText("نام کاربر با موفقیت دریافت شد");
                $this->message->sendAloneText("کاربر جدید با مشخصات زیر اضافه شد\n:شماره موبایل {$this->message->session_user_mobile}\nنام کامل: {$this->message->text}");
                $this->redirectBack();
            }
        } else {

            $this->message->sendAloneText("شماره موبایل کاربر یافت نشد!!!");
            $this->redirectBack();
        }

    }

    public function changeMargin()
    {
        $this->message->setRouteAction(self::$CHANGE_MARGIN);
        $btns = [
            'آبشده' => self::$ABSHODE_MARGIN,
            'سکه' => self::$COIN_MARGIN
        ];


        $this->message->sendTextWithInlineBtn("مارجین کدام را میخواهید تغییر دهید", $btns, true, true);

    }

    public function setMargin()
    {
        $this->message->setRouteAction(self::$SET_MARGIN);

        $this->message->setMarginType($this->message->callback_query_text);

        $this->message->sendAloneText("مقدار جدید را وارد کنید", true);

    }

    public function receiveMargin()
    {
        $this->message->setRouteAction(self::$RECEIVE_MARGIN);

        $setting = $this->settingBot();
        if ($this->message->session_margin_type === self::$COIN_MARGIN) {


            $setting->setCoinMargin((float)to_english_numbers($this->message->text));
        } else {

            $setting->setAbshodeMargin((float)to_english_numbers($this->message->text));
        }

        $this->message->sendAloneText('مقدار جدید باموفقیت دریافت و ثبت شد');

        $this->redirectBack();
    }


    public function deleteUser()
    {


        $this->message->setRouteAction(self::$DELETE_USER);

        $btns = [];
        $users = User::all();
        foreach ($users as $user) {
            $btns[$user->name] = 'delete:' . $user->id;
        }

        $this->message->sendTextWithInlineBtn('کاربر مورد نظر را انتخاب کنید.', $btns, true, true);
    }

    public function receiveDeleteUser()
    {
        $this->message->setRouteAction(self::$RECEIVE_DELETE_USER);
        $id = explode(':', trim($this->message->callback_query_text));
        if (array_key_exists(1, $id)) {

            $user = User::find($id[1]);
            if (!is_null($user)) {

                $user->delete();

                $this->message->sendAloneText('کاربر با موفقیت حذف شد');

                $this->redirectBack();
            } else {

                $this->message->sendAloneText('کاربر یافت نشد!!!');

                $this->redirectBack();
            }
        } else {

            $this->message->sendAloneText('کاربر یافت نشد!!!');

            $this->redirectBack();
        }
    }


    public function changeBalance()
    {
        $this->message->setRouteAction(self::$CHANGE_BALANCE);
        $btns = [
            'آبشده' => self::$ABSHODE_BALANCE,
            'سکه' => self::$COIN_BALANCE
        ];


        $this->message->sendTextWithInlineBtn("تراز کدام را میخواهید تغییر دهید", $btns, true, true);

    }

    public function setBalance()
    {
        $this->message->setRouteAction(self::$SET_BALANCE);

        $this->message->setBalanceType($this->message->callback_query_text);

        $this->message->sendAloneText("مقدار جدید را وارد کنید", true);

    }

    public function receiveBalance()
    {
        $this->message->setRouteAction(self::$RECEIVE_BALANCE);


        $setting = $this->settingBot();


        if ($this->message->session_balance_type === self::$COIN_BALANCE) {


            $setting->setCoinBalance((float)to_english_numbers($this->message->text));
        } else {

            $setting->setAbshodeBalance((float)to_english_numbers($this->message->text));
        }

        $this->message->sendAloneText('مقدار جدید باموفقیت دریافت و ثبت شد');

        $this->redirectBack();
    }


    public function startManualOrder()
    {
        $this->message->setRouteAction(self::$START_MANUAL_ORDER);
        $this->message->setStartManualOrder(true);
        $this->message->sendAloneText("کاربر مورد نظر را جستجو کنید.", true);
    }

    public function receiveManualOrderUser()
    {
        $this->message->setRouteAction(self::$RECIVE_MANUAL_ORDER_USER);

        $users = $this->userSearch(trim($this->message->text));
        if (!($users->count() > 0)) {
            $this->message->sendAloneText('کاربری یافت نشد!!!');
            $users = User::all();
        }
        foreach ($users as $user) {
            $btns[$user->name] = self::$MANUAL_ORDER_SUBMISSION . ':' . $user->id;
        }

        $this->message->sendTextWithInlineBtn("کاربر مورد نظر را انتخاب کنید.", $btns, true, true);
    }

    public function receiveUserAndStartManualOrder()
    {
        $this->message->setRouteAction(self::$RECIVE_AND_START_MANUAL_ORDER_USER);

        $id = explode(':', trim($this->message->callback_query_text));
        if (array_key_exists(1, $id)) {

            $user = User::find($id[1]);
            if (!is_null($user)) {
                $this->message->setUserIdManualOrder($user->id);
                $btns = ["آبشده" => self::$MANUAL_ORDER_SUBMISSION . '_' . self::$ABSHODE, 'سکه' => self::$MANUAL_ORDER_SUBMISSION . '_' . self::$COIN];
                $this->message->sendTextWithInlineBtn('لطفا نوع معامله را مشخص کنید', $btns, true, true);
            } else {

                $this->message->sendAloneText('کاربر یافت نشد!!!');

                $this->redirectBack();
            }
        } else {

            $this->message->sendAloneText('کاربر یافت نشد!!!');

            $this->redirectBack();
        }
    }

    public function receiveOrderItem()
    {
        $this->message->setRouteAction(self::$RECEIVE_ORDER_ITEM);

        $this->message->setItemManualOrder(trim($this->message->callback_query_text));

        $this->message->sendAloneText('لطفا مظنه را تعیین کنید', true);
    }

    public function receivePriceAndSelectOrderType()
    {
        $this->message->setRouteAction(self::$RECEIVE_ORDER_PRICE);


        $this->message->setPriceManualOrder((float)to_english_numbers($this->message->text));

        $btns = ["فروش به ما" => self::$SELL_US_ORDER, "خرید از ما" => self::$BUY_FROM_US_ORDER];

        $this->message->sendTextWithInlineBtn('لطفا نحوه مبادله را مشخص کنید', $btns, true, true);
    }

    public function receiveTypeAndSelectOrderType()
    {
        $this->message->setRouteAction(self::$RECEIVE_ORDER_TYPE);
        $this->message->setTypeManualOrder(trim($this->message->callback_query_text));

        if ($this->message->session_item_manual_order === self::$MANUAL_ORDER_SUBMISSION . '_' . self::$COIN) {

            if ($this->message->session_type_manual_order === self::$SELL_US_ORDER) {

                $text = "قیمت فروش هر سکه امامی: {$this->message->getCoinPrice(self::$SELL)} 🔵";
            } else {

                $text = "قیمت خرید هر سکه امامی: {$this->message->getCoinPrice(self::$BUY)} 🔴";
            }

            $this->message->sendAloneText($text . "لطفا تعداد سکه را وارد نمایید\n👇👇👇\n", true);

        } elseif (self::$MANUAL_ORDER_SUBMISSION . '_' . self::$ABSHODE) {

            $btns = ["وزن" => self::$MANUAL_ORDER_SUBMISSION . '_' . self::$WEIGHT, "مبلغ" => self::$MANUAL_ORDER_SUBMISSION . '_' . self::$PRICE];

            $this->message->sendTextWithInlineBtn("لطفا واحد عملیات مبادله را مشخص کنید.", $btns, true, true);

        } else {

            $this->message->sendAloneText('نوع معامله یافت نشد');

            $this->redirectBack();
        }
    }

//////////
    public function setRequireOrderAbshode()
    {


        if (trim($this->message->callback_query_text) === self::$MANUAL_ORDER_SUBMISSION . '_' . self::$WEIGHT) {

            $this->message->setRouteAction(self::$MANUAL_ORDER_SUBMISSION . '_' . self::$REQUIRE_TRADE_ABSHODE_WEIGHT);

            $text = "لطفا وزن مورد نظر را وارد نمایید\n👇👇👇";
        } else {
            $this->message->setRouteAction(self::$MANUAL_ORDER_SUBMISSION . '_' . self::$REQUIRE_TRADE_ABSHODE_PRICE);
            $text = "لطفا مبلغ مورد نظر را وارد نمایید\n👇👇👇";
        }

        $this->message->sendAloneText($text, true);
    }


    public function receiveRequireOrderAbshode()
    {
        $this->message->setRouteAction(self::$MANUAL_ORDER_SUBMISSION . '_' . self::$RECEIVE_REQUIRE_TRADE_ABSHODE);

        if ($this->message->last_action === self::$MANUAL_ORDER_SUBMISSION . '_' . self::$REQUIRE_TRADE_ABSHODE_WEIGHT) {

            $this->message->setAbshodeWeightManualOrder((float)to_english_numbers($this->message->text));
            $text = 'وزن مورد نظر با موفقیت دریافت شد';
        } else {
            $this->message->setAbshodePriceManualOrder((float)to_english_numbers($this->message->text));
            $text = 'مبلغ مورد نظر با موفقیت دریافت شد';
        }
        $this->message->sendAloneText($text);

        $this->setupAbshodeOrder();
    }

    public function setupAbshodeOrder(): void
    {
        if (is_null($this->message->session_abshode_price_manual_order)) {

            $this->message->sendAloneText('قیمت یافت نشد!!!');


            $this->message->setRouteAction(self::$MANUAL_ORDER_SUBMISSION . '_' . self::$REQUIRE_TRADE_ABSHODE_PRICE);

            $text = "لطفا مبلغ مورد نظر را وارد نمایید\n👇👇👇";
            $this->message->sendAloneText($text, true);
            return;
        }
        if (is_null($this->message->session_abshode_weight_manual_order)) {

            $this->message->sendAloneText('وزن یافت نشد!!!');

            $this->message->setRouteAction(self::$MANUAL_ORDER_SUBMISSION . '_' . self::$REQUIRE_TRADE_ABSHODE_WEIGHT);

            $text = "لطفا وزن مورد نظر را وارد نمایید\n👇👇👇";


            $this->message->sendAloneText($text, true);
            return;
        }
        $this->message->setRouteAction(self::$MANUAL_ORDER_SUBMISSION . '_' . self::$SETUP_ABSHODE_TRADE);

        $gram = $this->message->getGramPrice($this->message->session_type_manual_order);
        $abshode = $this->message->getAbshode($this->message->session_type_manual_order);
        $totalAbshode = (float)$this->message->getTotalAbshode($this->message->session_type_manual_order) * (float)$this->message->session_abshode_weight_manual_order;

        $this->message->setTotalInvoiceManualOrder($totalAbshode);

        $lable = $this->message->session_type_manual_order === self::$SELL_US_ORDER ? "🔵" : "🔴";
        $time = time_fa($this->message->created_at);
        $user = $this->userFind($this->message->session_user_id_manual_order);
        $text = "نوع خرید: {$this->message->session_item_manual_order_fa}\nعملیات مورد نظر: {$this->message->session_type_manual_order_fa}\nوزن: {$this->message->session_abshode_weight_manual_order}\nقیمت {$this->message->session_type_manual_order_fa} هر گرم: $gram $lable\nقیمت {$this->message->session_type_manual_order_fa} آبشده: {$abshode} $lable\nقیمت کل: $totalAbshode\nشماره مشتری: +$user?->mobile\nنام و نام خانوادگی مشتری: $user?->name\nتاریخ معامله: $time";

        $this->message->sendTextWithInlineBtn($text, ["بله تایید میکنم" => self::$MANUAL_ORDER_SUBMISSION . '_' . self::$CONFIRM], true);
    }

    public function endSetupAbshodeOrder(): void
    {
        if ((float)$this->message->session_total_invoice_manual_order !== (float)$this->message->getTotalAbshode($this->message->session_type_manual_order)) {
            $this->chatSessionClear();
            $this->message->sendTextWithInlineBtn("قیمت ها به روزرسانی شده اند لطفا دوباره تلاش کنید", ["شروع مجدد" => self::$MANUAL_ORDER_SUBMISSION]);
            return;
        }
        $this->submitOrder();
        $this->chatSessionClear();
        $this->message->sendAloneText("معاملات شما با موفقیت انجام شد.");
        return;
    }

    /////

    public function receiveManualOrderCoinAmount(): void
    {

        $text = (int)to_english_numbers($this->message->text);
        if ($text === 0) {

            $this->message->sendAloneText("تعداد وارده معتبر نیست. لطفا دوباره تلاش کنید ...", true);
            return;
        }

        $this->message->setRouteAction(self::$MANUAL_ORDER_SUBMISSION . '_' . self::$RECIVE_COIN_AMOUNT);

        if ($this->message->session_item_manual_order === self::$MANUAL_ORDER_SUBMISSION . '_' . self::$COIN) {

            $this->message->setCoinAmountManualOrder($text);

            $this->setupCoinManualOrder();
            return;
        }
    }

    public function setupCoinManualOrder()
    {
        $this->message->setRouteAction(self::$MANUAL_ORDER_SUBMISSION . '_' . self::$SETUP_COIN_TRADE);


        $this->message->setTotalInvoiceManualOrder($this->message->getTotalCoinPrice($this->message->session_type_manual_order));

        $lable = $this->message->session_type_manual_order === self::$SELL_US_ORDER ? "🔵" : "🔴";
        $time = time_fa($this->message->created_at);

        $user = $this->userFind($this->message->session_user_id_manual_order);

        $text = "نوع خرید: {$this->message->session_item_manual_order_fa}\nعملیات مورد نظر: {$this->message->session_type_manual_order_fa}\nتعداد: {$this->message->session_coin_amount_manual_order}\nقیمت {$this->message->session_type_manual_order_fa} هر سکه امامی: {$this->message->getCoinPrice($this->message->session_type_manual_order)}  $lable \nقیمت کل: {$this->message->getTotalCoinPrice($this->message->session_type_manual_order)}\nشماره مشتری: +$user?->mobile\nنام و نام خانوادگی مشتری: $user?->name\nتاریخ معامله: $time";


        $this->message->sendTextWithInlineBtn($text, ["بله تایید میکنم" => self::$MANUAL_ORDER_SUBMISSION . '_' . self::$CONFIRM], true);
    }

    public function endSetupCoinManualOrder(): void
    {

        if ((float)$this->message->session_total_invoice_manual_order !== (float)$this->message->getTotalCoinPrice($this->message->session_type_manual_order)) {
            $this->chatSessionClear();
            $this->message->sendTextWithInlineBtn("قیمت ها به روزرسانی شده اند لطفا دوباره تلاش کنید", ["شروع مجدد" => self::$MANUAL_ORDER_SUBMISSION]);
            return;
        }
        $this->submitOrder();
        $this->chatSessionClear();
        $this->message->sendAloneText("معاملات شما با موفقیت انجام شد.");
        return;
    }

///////////


    public function reportOrders()
    {
        $this->message->setRouteAction(self::$REPORT);

        $orders = OrderBot::with('user')->orderByDesc('created_at')->get();
        $name = 'ReportOrders__' . now_fa() . '__.xlsx';
        $path = 'documents/' . $name;

        (new OrdersExport($orders))->store($path);

        $path = '/storage/' . $path;

        $this->message->sendDocument($path, now_fa(), $name);
    }

////////
    public function redirectBack()
    {

        $routeMap = collect([
            ['fn' => 'startBot', 'route' => self::$START_ACTION],
            ['fn' => 'changeLockTime', 'route' => self::$CHANGE_LOCK],
            ['fn' => 'addUser', 'route' => self::$ADD_USER],
            ['fn' => 'deleteUser', 'route' => self::$DELETE_USER],
            ['fn' => 'changeBalance', 'route' => self::$CHANGE_BALANCE],

        ]);

        $fn = optional($routeMap->where('route', $this->backRoute())->first())['fn'] ?? 'startBot';


        $this->{$fn}();
    }

    public function backRoute()
    {
        $action = $this->message->getCleanChatSession()->chatRoutes
            ->where('action', '!=', self::$BACK)
            ->where('action', '!=', self::$CHANGE_START_LOCK)
            ->where('action', '!=', self::$RECEIVE_START_LOCK_TIME)
            ->where('action', '!=', self::$CHANGE_STOP_LOCK)
            ->where('action', '!=', self::$RECEIVE_STOP_LOCK_TIME)
            ->where('action', '!=', self::$ADD_USER_MOBILE)
            ->where('action', '!=', self::$ADD_USER_NAME)
            ->where('action', '!=', self::$RECEIVE_MARGIN)
            ->where('action', '!=', self::$SET_MARGIN)
            ->where('action', '!=', self::$RECEIVE_DELETE_USER)
            ->where('action', '!=', self::$RECEIVE_BALANCE)
            ->where('action', '!=', self::$SET_BALANCE)
            ?->sortByDesc('id')
            ->skip(1)->first()?->action;

        $this->message->getCleanChatSession()->chatRoutes
            ->where('action', '!=', self::$BACK)
            ->where('action', '!=', self::$CHANGE_START_LOCK)
            ->where('action', '!=', self::$RECEIVE_START_LOCK_TIME)
            ->where('action', '!=', self::$CHANGE_STOP_LOCK)
            ->where('action', '!=', self::$RECEIVE_STOP_LOCK_TIME)
            ->where('action', '!=', self::$ADD_USER_MOBILE)
            ->where('action', '!=', self::$ADD_USER_NAME)
            ->where('action', '!=', self::$RECEIVE_MARGIN)
            ->where('action', '!=', self::$SET_MARGIN)
            ->where('action', '!=', self::$RECEIVE_DELETE_USER)
            ->where('action', '!=', self::$RECEIVE_BALANCE)
            ->where('action', '!=', self::$SET_BALANCE)
            ?->sortByDesc('id')
            ->take(2)->each->delete();

        return $action;
    }

    private function settingBot()
    {
        return SettingBot::where('bot_tag', SettingBot::$MMD_TALA)->firstOrCreate(['bot_tag' => SettingBot::$MMD_TALA]);
    }

    private function userSearch(string $text)
    {
        return User::where('name', 'like', "%$text%")->get();
    }

    private function userFind($id)
    {
        return User::find($id);
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
        $data['user_id'] = $this->message->session_user_id_manual_order;
        $data['type'] = $this->message->session_type_manual_order;
        $data['item'] = $this->message->session_item_manual_order;
        $data['price'] = $this->message->session_abshode_price_manual_order;
        $data['weight'] = $this->message->session_abshode_weight_manual_order;
        $data['count'] = $this->message->session_coin_amount_manual_order;

        self::createOrder($data);
    }
}
