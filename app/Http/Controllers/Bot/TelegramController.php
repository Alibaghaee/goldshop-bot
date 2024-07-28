<?php

namespace App\Http\Controllers\Bot;

use App\Events\UpdateHookEvent;
use App\Http\Controllers\Controller;
use App\Observers\GoldScraperObserver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Spatie\Crawler\Crawler;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{


    public function setHook()
    {

        Telegram::bot('mmd_tala_bot')->removeWebhook();
        $telegram1 = Telegram::bot('mmd_tala_bot')->setWebhook(['url' => 'https://gold.rahco.ir/api/first/23124/hook', 'secret_token' => env('TELEGRAM_SECRET_HEADER')]);


        Telegram::bot('mmd_tala_bot_user')->removeWebhook();
        $telegram2 = Telegram::bot('mmd_tala_bot_user')->setWebhook(['url' => 'https://gold.rahco.ir/api/second/23124/hook', 'secret_token' => env('TELEGRAM_SECRET_HEADER')]);


        Telegram::bot('mmd_tala_bot_price_manager')->removeWebhook();
        $telegram3 = Telegram::bot('mmd_tala_bot_price_manager')->setWebhook(['url' => 'https://gold.rahco.ir/api/third/23124/hook', 'secret_token' => env('TELEGRAM_SECRET_HEADER')]);

        return response([
            'telegram' => $telegram1,
            'telegram2' => $telegram2,
            'telegram3' => $telegram3,
        ]);
    }

    public function firstHook()
    {
        $updates = Telegram::bot('mmd_tala_bot')->getWebhookUpdate();


        info('#################__first__#######################\n####\\n');
        info($updates);

        event(new UpdateHookEvent(collect(json_decode($updates, true)),  botRole:'manager'));

        return 'ok';
    }

    public function secondHook()
    {
        $updates = Telegram::bot('mmd_tala_bot_user')->getWebhookUpdate();


        info('##################__second__######################\n####\\n');
        info($updates);

        event(new UpdateHookEvent(collect(json_decode($updates, true)),  botRole:'user'));

        return 'ok';
    }

    public function thirdHook()
    {
        $updates = Telegram::bot('mmd_tala_bot_price_manager')->getWebhookUpdate();


        info('######################__third__##################\n####\\n');
        info($updates);

        event(new UpdateHookEvent(collect(json_decode($updates, true)), botRole:'price_manager'));

        return 'ok';
    }


}
