<?php

namespace App\Interfaces;

interface TelegramBot
{


    public function config(string $bot);

    public function send($data);
}
