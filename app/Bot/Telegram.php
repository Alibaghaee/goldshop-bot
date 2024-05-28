<?php

namespace App\Bot;

use App\Interfaces\TelegramBot;

class Telegram implements TelegramBot
{

    public $bot;

    public function __construct()
    {
        $this->config('mmd_tala_bot');
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
