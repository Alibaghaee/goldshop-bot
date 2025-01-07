<?php

namespace App\Repository\Telegram\PriceAbshodeManagerPattern;

use App\Models\MessageBot;
use App\Models\SettingBot;
use App\Repository\Telegram\MessageBotRepoController;

class PriceAbshodeManagerRepoController extends MessageBotRepoController
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

        $base = ($number - ($this->settingBot()->abshode_margin));
        $roof = ($number + ($this->settingBot()->abshode_margin));

        $this->settingBot()->setSellingAbshode($roof);
        $this->settingBot()->setBuyingAbshode($base);
        $this->settingBot()->setSellingGram(round($roof / 4.3318, 3));
        $this->settingBot()->setBuyingGram(round($base / 4.3318, 3));

        $text = "قیمت خرید آبشده:  " . to_english_numbers(number_format($base, 3)) . "  🔴\n" .
            "قیمت فروش آبشده:  " . to_english_numbers(number_format($roof, 3)) . " 🔵\n" .
            "قیمت خرید گرم:  " . to_english_numbers(number_format(round($base / 4.3318, 3), 3)) . "  🔴\n" .
            "قیمت فروش گرم:  " . to_english_numbers(number_format(round($roof / 4.3318, 3), 3)) . " 🔵\n" . "@wwwabshodeir";


        $btns = ["ربات معاملات" => "t.me/mmd_tala_user_bot"];

        $this->message->sendCustomChatTextWithBtnUrl(self::$CHANNEL_CHAT_ID, $text, $btns, true);

        $this->message->sendAloneText($text);
    }


    private function settingBot()
    {
        return SettingBot::where('bot_tag', SettingBot::$MMD_TALA)->firstOrCreate(['bot_tag' => SettingBot::$MMD_TALA]);
    }

}
