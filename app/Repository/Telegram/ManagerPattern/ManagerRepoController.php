<?php

namespace App\Repository\Telegram\ManagerPattern;

use App\Models\MessageBot;
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

                if (trim($message->callback_query_text) === self::$CHANGE_LOCK) {

                    $this->changeLockTime();
                }
            } else {

                if (trim($message->text) === self::$START) {

                    $this->startBot();
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
        $this->message->sendTextWithInlineBtn("برای تنظیم قفل زمانی معاملات لطفا عملیات مورد نظر را انتخاب کنید", $btns, true);
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


                $this->message->setRouteAction(self::$RECEIVE_START_LOCK_TIME);


                $this->message->sendAloneText("ساعت شروع کار ربات با موفقیت دریافت شد.");

                $this->redirectBack();
            }

        } else {
            $this->message->sendAloneText("فرمت ورودی اشتباه است!!!");
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


                $this->message->sendAloneText("ساعت پایان کار ربات با موفقیت دریافت شد.");

                $this->redirectBack();
            }

        } else {
            $this->message->sendAloneText("فرمت ورودی اشتباه است!!!");
        }


    }


    public function redirectBack()
    {

        $routeMap = collect([
            ['fn' => 'startBot', 'route' => self::$START_ACTION],
            ['fn' => 'changeLockTime', 'route' => self::$CHANGE_LOCK],

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
            ?->sortByDesc('id')
            ->skip(1)->first()?->action;

        $this->message->getCleanChatSession()->chatRoutes
            ->where('action', '!=', self::$BACK)
            ->where('action', '!=', self::$CHANGE_START_LOCK)
            ->where('action', '!=', self::$RECEIVE_START_LOCK_TIME)
            ->where('action', '!=', self::$CHANGE_STOP_LOCK)
            ->where('action', '!=', self::$RECEIVE_STOP_LOCK_TIME)
            ?->sortByDesc('id')
            ->take(2)->each->delete();

        return $action;
    }
}
