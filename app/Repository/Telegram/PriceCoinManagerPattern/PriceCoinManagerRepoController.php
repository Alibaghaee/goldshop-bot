<?php

namespace App\Repository\Telegram\PriceCoinManagerPattern;

use App\Models\MessageBot;
use App\Models\SettingBot;
use App\Repository\Telegram\MessageBotRepoController;

class PriceCoinManagerRepoController extends MessageBotRepoController
{


    public function __construct(MessageBot $message)
    {
        parent::__construct($message);

        if ($this->chatSessionCheck()) {


            $this->chatSessionClear();
        }
        if (!$message->from_is_bot) {

            if ($message->text) {
                $this->receivePrice();
            }
        }

    }


    public function receivePrice()
    {
        $this->message->setRouteAction(self::$RECEIVE_PRICE);
        $number = (float)to_english_numbers($this->message->text);

        $base = ($number - ($this->settingBot()->coin_margin));
        $roof = ($number + ($this->settingBot()->coin_margin));
        $this->settingBot()->setSellingCoin($roof);
        $this->settingBot()->setBuyingCoin($base);

        $text = "خرید سکه امامی:  " . to_english_numbers(number_format($base, 3)) . "  🔴\n" .
            "فروش سکه امامی:  " . to_english_numbers(number_format($roof, 3)) . " 🔵\n" . "@wwwabshodeir";

        $btns = ["ربات معاملات" => "t.me/mmd_tala_user_bot"];

        $this->message->sendCustomChatTextWithBtnUrl(self::$CHANNEL_CHAT_ID, $text, $btns, true);

        $this->message->sendAloneText($text);
    }


    private function settingBot()
    {
        return SettingBot::where('bot_tag', SettingBot::$MMD_TALA)->firstOrCreate(['bot_tag' => SettingBot::$MMD_TALA]);
    }

}
