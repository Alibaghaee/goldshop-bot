<?php

namespace App\Bot\Factory;

class PriceCoinManagerBot implements BotInterface
{
    public $bot;


    public function __construct()
    {
        $this->config('mmd_tala_bot_price_coin');
    }

    public function config(string $bot)
    {
        $this->bot = \Telegram\Bot\Laravel\Facades\Telegram::bot($bot);
    }

    public function send($data)
    {
        $this->bot->sendMessage($data);
    }

    public function sendDocument($data)
    {
        $this->bot->sendDocument($data);
    }
}
