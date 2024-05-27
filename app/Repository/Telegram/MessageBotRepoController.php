<?php

namespace App\Repository\Telegram;

use App\Models\MessageBot;

abstract class MessageBotRepoController
{

    protected MessageBot $message;


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


    public static $CHANGE_LOCK = 'change_lock';

    public static $ADD_USER = 'add_user';

    public static $ADD_USER_MOBILE = 'add_user_mobile';

    public static $ADD_USER_NAME = 'add_user_name';

    public static $CHANGE_MARGIN = 'change_margin';

    public static $REMOVE_USER = 'remove_user';

    public static $CHANGE_BALANCE = 'change_balance';

    public static $MANUAL_ORDER_SUBMISSION = 'manual_order_submission';

    public static $REPORT = 'report';

    public static $CHANGE_START_LOCK = 'change_start_lock';

    public static $CHANGE_STOP_LOCK = 'change_stop_lock';

    public static $RECEIVE_START_LOCK_TIME = 'receive_start_lock_time';

    public static $RECEIVE_STOP_LOCK_TIME = 'receive_stop_lock_time';

    public function __construct(MessageBot $message)
    {

        $this->message = $message;
    }

    public function chatSessionClear()
    {


        $this->message->chatSessionClear();
    }


    public function chatSessionCheck()
    {
        return $this->message->chatSessionCheck();
    }
}
