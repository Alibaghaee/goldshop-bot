<?php

namespace App\Bot\Factory;

interface BotInterface
{

    public function config(string $bot);

    public function send($data);


    public function sendDocument($data);

}
