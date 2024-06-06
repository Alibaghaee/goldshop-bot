<?php

namespace App\Repository\Telegram;

use App\Models\MessageBot;
use App\Models\OrderBot;

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

    public static $ABSHODE_MARGIN = 'abshode_margin';

    public static $ABSHODE_BALANCE = 'abshode_balance';

    public static $COIN_MARGIN = 'coin_margin';

    public static $COIN_BALANCE = 'coin_balance';

    public static $SET_MARGIN = 'set_margin';

    public static $SET_BALANCE = 'set_balance';

    public static $RECEIVE_MARGIN = 'receive_margin';

    public static $RECEIVE_BALANCE = 'receive_balance';

    public static $DELETE_USER = 'delete_user';

    public static $RECEIVE_DELETE_USER = 'receive_user';

    public static $START_MANUAL_ORDER = 'start_manual_order';

    public static $RECIVE_MANUAL_ORDER_USER = 'receive_manual_order_user';

    public static $RECIVE_AND_START_MANUAL_ORDER_USER = 'receive_and_start_manual_order_user';

    public static $RECEIVE_ORDER_ITEM = 'receive_order_item';

    public static $RECEIVE_ORDER_TYPE = 'receive_order_type';

    public static $RECEIVE_ORDER_PRICE = 'receive_order_price';

    public static $SELL_US_ORDER = 'sell_us_order';

    public static $BUY_FROM_US_ORDER = 'buy_from_us_order';

    public static $CHANGE_COIN_PRICE = 'change_coin_price';

    public static $CHANGE_ABSHODE_PRICE = 'change_abshode_price';

    public static $CHANGE_PRICE = 'change_price';

    public static $RECEIVE_PRICE = 'receive_price';

    public static $CHANNEL_CHAT_ID = '6259458432'; ///"@wwwabshodeir"

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


    public static function hasUnsignedFloatAndInt($value)
    {
        return preg_match("/^[0-9]{1,100}(\.[0-9]{1,10})?$/", trim($value));
    }

    public static function createOrder(array $data)
    {
        return OrderBot::create($data);
    }

    public static function beautyCurrency($price)
    {
        return number_format($price, 3, '.', ',');
    }
}
