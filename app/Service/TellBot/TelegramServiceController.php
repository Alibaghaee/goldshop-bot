<?php

namespace App\Service\TellBot;

use App\Bot\Telegram;


class TelegramServiceController
{
    private Telegram $bot;


    public function __construct()
    {

        $this->bot = new Telegram();
    }

    public function send($data)
    {

        $this->bot->send($data);
    }
}
