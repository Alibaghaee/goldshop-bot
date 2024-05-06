<?php

namespace App\Providers;

use App\Bot\Telegram;
use App\Interfaces\TelegramBot;
use App\Service\TellBot\TelegramServiceController;
use Illuminate\Support\ServiceProvider;

class TelegramServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
