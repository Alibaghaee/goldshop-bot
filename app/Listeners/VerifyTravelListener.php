<?php

namespace App\Listeners;

use App\Events\VerifyTravelEvent;
use App\Jobs\SendSMSMessageUser;
use App\Models\General\SmsTemplate;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyTravelListener
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
     * @param VerifyTravelEvent $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->travel->checkHasUserWalletCharge($event->price)) {

            $event->travel->user->withdrawalWallet($event->price);
            $message = SmsTemplate::getMessageWithTag(SmsTemplate::$VERIFIED,'مشترک گرامی درخواست سفر شما با موفقیت تایید شد.');
            $message = $message . ' کد رهگیری: ' . $event->travel->tracking_code . ' مبلغ:  ' . "{$event->price}";

            SendSMSMessageUser::dispatch($event->travel->user, $message)->onQueue('send_message_user');
        }
    }
}
