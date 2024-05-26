<?php

namespace App\Repository\Telegram;

use App\Models\MessageBot;

abstract class MessageBotRepoController
{

    protected MessageBot $message;

    public function __construct(MessageBot $message)
    {

        $this->message = $message;
    }




}
