<?php

namespace App\Http\Controllers\Bot;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;

class TestController extends Controller
{
    public function test1()
    {

        $telegram = Telegram::bot('mmd_tala_bot');  ///->setAsyncRequest(true);
//            dd($telegram->getMe());
//        $id = $telegram->getMe()->getId();
//        dd($telegram->getUpdates()[0]['message']['chat']['id']);


        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->setOneTimeKeyboard(true)
            ->row([
                Keyboard::button('۱'),
                Keyboard::button('۲'),
                Keyboard::button('۳'),
            ]);


        $messageSend = [];
        if (array_key_exists(0, $telegram->getUpdates())) {

            $messageSend = $telegram->sendMessage([
//            'chat_id' => $id,
                'chat_id' => $telegram->getUpdates()[0]['message']['chat']['id'],
                'text' => 'گزینه مورد نظر خودتو بگو',
                'reply_markup' => $reply_markup
            ]);
        }
        return $messageSend;
    }

    public function test2()
    {
        $token = '6949811914:AAFefAuniK7H8t8zrj3AhQsLm30phgTWH64';
        $send = Http::get('https://api.telegram.org/bot' . $token . '/getMe');
        $body = $send->json();
        $id = $body['result']['id'];
        $message = Http::get('https://api.telegram.org/bot' . $token . '/getMe');

        dd($body);
    }
}
