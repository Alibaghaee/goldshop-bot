<?php

namespace App\Repository\Telegram\PriceManagerPattern;

use App\Models\MessageBot;
use App\Models\SettingBot;
use App\Repository\Telegram\MessageBotRepoController;

class PriceManagerRepoController extends MessageBotRepoController
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


                if (trim($message->callback_query_text) === self::$CHANGE_MARGIN) {

                    $this->changeMargin();
                }

                if (trim($message->callback_query_text) === self::$BACK) {

                    $this->redirectBack();
                }
                if (trim($message->callback_query_text) === self::$ABSHODE_MARGIN || trim($message->callback_query_text) === self::$COIN_MARGIN) {

                    $this->setMargin();
                }
                if (trim($message->callback_query_text) === self::$CHANGE_COIN_PRICE || trim($message->callback_query_text) === self::$CHANGE_ABSHODE_PRICE) {

                    $this->changePrice();
                }
            } else {

                if (trim($message->text) === self::$START) {

                    $this->startBot();
                } elseif ($message->last_action === self::$SET_MARGIN) {

                    $this->receiveMargin();
                } elseif ($message->last_action === self::$CHANGE_PRICE) {

                    $this->receivePrice();
                }
            }


        }

    }


    public function startBot(): void
    {
        $this->message->setRouteAction(self::$START_ACTION);
        $this->message->setStartBot(true);
        $this->message->sendTextWithBtn('شروع', [self::$START]);
        $btns = ['سکه' => self::$CHANGE_COIN_PRICE, 'آبشده' => self::$CHANGE_ABSHODE_PRICE, 'مارجین' => self::$CHANGE_MARGIN];
        $this->message->sendTextWithInlineBtn("به ربات معامله گر خوش آمدید \n گزینه مورد نظر خود را انتخاب کنید. ", $btns, false, true);
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

////
    public function changePrice()
    {
        $this->message->setRouteAction(self::$CHANGE_PRICE);

        $this->message->setItem(trim($this->message->callback_query_text));
        $this->message->sendAloneText("مقدار جدید را وارد کنید", true);
    }

    public function receivePrice()
    {
        $this->message->setRouteAction(self::$RECEIVE_PRICE);
        $number = (float)to_english_numbers($this->message->text);
        if ($this->message->session_item === self::$CHANGE_ABSHODE_PRICE) {
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

        } else {
            $base = ($number - ($this->settingBot()->coin_margin));
            $roof = ($number + ($this->settingBot()->coin_margin));
            $this->settingBot()->setSellingCoin($roof);
            $this->settingBot()->setBuyingCoin($base);

            $text = "خرید سکه امامی:  " . to_english_numbers(number_format($base, 3)) . "  🔴\n" .
                "فروش سکه امامی:  " . to_english_numbers(number_format($roof, 3)) . " 🔵\n" . "@wwwabshodeir";
        }
        $btns = ["ربات معاملات" => "t.me/mmd_tala_user_bot"];

        $this->message->sendCustomChatTextWithBtnUrl(self::$CHANNEL_CHAT_ID, $text, $btns, true);

        $this->message->sendAloneText("با موفقیت ثبت شد.");
    }

    public function redirectBack()
    {

        $routeMap = collect([
            ['fn' => 'startBot', 'route' => self::$START_ACTION],

        ]);

        $fn = optional($routeMap->where('route', $this->backRoute())->first())['fn'] ?? 'startBot';


        $this->{$fn}();
    }

    public function backRoute()
    {
        $action = $this->message->getCleanChatSession()->chatRoutes
            ->where('action', '!=', self::$BACK)
            ?->sortByDesc('id')
            ->skip(1)->first()?->action;

        $this->message->getCleanChatSession()->chatRoutes
            ->where('action', '!=', self::$BACK)
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

    private function settingBot()
    {
        return SettingBot::where('bot_tag', SettingBot::$MMD_TALA)->firstOrCreate(['bot_tag' => SettingBot::$MMD_TALA]);
    }

}
