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

class TestController extends Controller
{
    public function test1()
    {

        $telegram = Telegram::bot('mmd_tala_bot');  ///->setAsyncRequest(true);
//            dd($telegram->getMe());
//        $id = $telegram->getMe()->getId();
//        dd($telegram->getUpdates()[0]['message']['chat']['id']);


//        $reply_markup = Keyboard::make()
//            ->setResizeKeyboard(true)
//            ->setOneTimeKeyboard(true)
//            ->inline()
//            ->row([
//                Keyboard::inlineButton(['text' => 'به اشتراک گذاری شماره تلفن همراه', 'request_contact' => true, 'callback_data' => '/request_contact']),
//
//            ]);


//        $messageSend = $telegram->sendMessage([
//
//            'chat_id' => '6259458432',
//            'text' => 'با سلام خدمت شما دوست عزیز. از طریق این بات می توانید سفارش خود را به سادگی ثبت کنید. برای بازگشت بین مراحل از دستور /back کنید. اگر آماده هستید با فشردن دکمه اشتراگ گذاری شماره همراه ادامه دهید.',
//            'reply_markup' => $reply_markup
//
//        ]);
//        $messageSend = [];
//        if (array_key_exists(0, $telegram->getUpdates())) {
//
//            $messageSend = $telegram->sendMessage([
////            'chat_id' => $id,
//                'chat_id' => $telegram->getUpdates()[0]['message']['chat']['id'],
//                'text' => 'گزینه مورد نظر خودتو بگو',
//                'reply_markup' => $reply_markup
//            ]);
//        }
//        return \Storage::url('docments/test.pdf','test.pdf');
//        return asset('docments/test.pdf');

        $messageSend= $telegram->sendDocument([
            'chat_id' => '6259458432',
            'document' =>InputFile::create(asset('/storage/docments/test2.pdf'),'test2.pdf') ,
            'caption' => 'test',
        ]);
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


    public function setHook()
    {
        Telegram::bot('mmd_tala_bot')->removeWebhook();
        $telegram = Telegram::bot('mmd_tala_bot')->setWebhook(['url' => 'https://gold.rahco.ir/api/h/23124/hook']);

        return $telegram;
    }

    public function hook()
    {
        $updates = Telegram::bot('mmd_tala_bot')->getWebhookUpdate();


        info('########################################\n####\\n');
        info($updates);

        event(new UpdateHookEvent(collect(json_decode($updates, true))));

        return 'ok';
    }

    public function testTala()
    {
//        $c=0;
//        for ($i = 1; $i < 1000; $i++) {
//            $c++;
//            $response = Http::get('https://www.estjt.ir/price/');
//            if ($response->status()!==200|| $response->requestTimeout()){
//                return $response->status();
//                break;
//            }
//
//
//        }
        $url = 'https://www.estjt.ir/price/';
        Crawler::create()
            ->setCrawlObserver(new GoldScraperObserver())
            ->setMaximumDepth(0)
            ->setTotalCrawlLimit(1)
            ->startCrawling($url);

        return 'ok';
    }


}
