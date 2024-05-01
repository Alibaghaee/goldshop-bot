<?php

namespace App\Listeners;

use App\Events\SendPurchaseLinkEvent;
use App\Jobs\SendSMSMessageMobile;
use App\Jobs\SendSMSMessageUser;
use App\Models\General\Pay;
use App\Models\General\Purchase;
use App\Models\General\SmsTemplate;
use App\WalletActionLog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPurchaseLinkListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param SendPurchaseLinkEvent $event
     * @return void
     */
    public function handle($event): void
    {

        if (WalletActionLog::checkActivity($event->user->id)) {
            $wallet = WalletActionLog::create([
                'user_id' => $event->user->id,
                'amount' => to_english_numbers(trim(explode('*', $event->item->note)[2])),
            ]);

            $message = SmsTemplate::getMessageWithTag(SmsTemplate::$SEND_GATEWAY_LINK, 'مشترک گرامی درخواست شما برای شارژ کیف پول ثبت شد لطفا جهت پرداخت از طریق لینک زیر اقدام کنید.');

            $message = $message . '     ' . route('wallet.charge', $wallet->uuid);

        } else {

            $message = SmsTemplate::getMessageWithTag(SmsTemplate::$SEND_GATEWAY_LINK_ERROR, 'درخواست شما برای شارژ کیف پول بیش از حد مجاز است لطفا بعدا تلاش کنید.');

        }

        SendSMSMessageMobile::dispatch($event->item->sender_number, $message)->onQueue('send_message_user');
    }
}
