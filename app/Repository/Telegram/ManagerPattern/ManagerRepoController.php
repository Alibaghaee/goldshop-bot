<?php

namespace App\Repository\Telegram\ManagerPattern;

use App\Models\MessageBot;
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

                if (trim($message->callback_query_text) === self::$ABSHODE_MARGIN || trim($message->callback_query_text) === self::$COIN_MARGIN) {

                    $this->setMargin();
                }
                if (trim($message->callback_query_text) === self::$REMOVE_USER) {

                    $this->deleteUser();
                }
                if ($message->last_action === self::$DELETE_USER && str_contains(trim($message->callback_query_text), 'delete:')) {


                    $this->receiveDeleteUser();

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
                }
            }


        }


    }


    public function startBot()
    {
        $this->message->setRouteAction(self::$START_ACTION);
        $this->message->setStartBot(true);

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
            $text[0] = (int)to_english_numbers($text[0]);
            $text[1] = (int)to_english_numbers($text[1]);

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

        if (preg_match('/^09\d{9}$/', to_english_numbers(trim($this->message->text)))) {

            $this->message->setUserMobile(to_english_numbers(trim($this->message->text)));
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

    public function redirectBack()
    {

        $routeMap = collect([
            ['fn' => 'startBot', 'route' => self::$START_ACTION],
            ['fn' => 'changeLockTime', 'route' => self::$CHANGE_LOCK],
            ['fn' => 'addUser', 'route' => self::$ADD_USER],
            ['fn' => 'deleteUser', 'route' => self::$DELETE_USER],

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
            ?->sortByDesc('id')
            ->take(2)->each->delete();

        return $action;
    }

    private function settingBot()
    {
        return SettingBot::where('bot_tag', SettingBot::$MMD_TALA)->firstOrCreate(['bot_tag' => SettingBot::$MMD_TALA]);
    }
}
