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
            } else {

                if (trim($message->text) === self::$START) {

                    $this->startBot();
                } elseif (trim($message->text) === self::$BACK) {
                    $this->redirectBack();
                } elseif ($message->last_action === self::$CHANGE_START_LOCK) {
                    $this->receiveStartLockTime();
                } elseif ($message->last_action === self::$CHANGE_STOP_LOCK) {
                    $this->receiveStopLockTime();
                } elseif ($message->last_action === self::$ADD_USER) {
                    $this->receiveUserMobile();
                } elseif ($message->last_action === self::$ADD_USER_MOBILE) {
                    $this->receiveUserName();
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

                $setting = SettingBot::where('bot_tag', SettingBot::$MMD_TALA)->firstOrCreate(['bot_tag' => SettingBot::$MMD_TALA]);
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

                $setting = SettingBot::where('bot_tag', SettingBot::$MMD_TALA)->firstOrCreate(['bot_tag' => SettingBot::$MMD_TALA]);
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

        if (preg_match("/^09[0-9]{9}$/", (int)to_english_numbers(trim($this->message->text)))) {

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

            $this->message->setRouteAction(self::$ADD_USER_NAME);

            User::create(['mobile' => $this->message->session_user_mobile, 'name' => $this->message->text]);


            $this->message->sendAloneText("نام کاربر با موفقیت دریافت شد", true);
        }
        $this->message->sendAloneText("شماره موبایل کاربر یافت نشد!!!");

        $this->redirectBack();
    }

    public function redirectBack()
    {

        $routeMap = collect([
            ['fn' => 'startBot', 'route' => self::$START_ACTION],
            ['fn' => 'changeLockTime', 'route' => self::$CHANGE_LOCK],
            ['fn' => 'addUser', 'route' => self::$ADD_USER],

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
            ?->sortByDesc('id')
            ->take(2)->each->delete();

        return $action;
    }
}
