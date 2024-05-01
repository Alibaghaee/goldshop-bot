<?php

namespace App\Listeners;

use App\Jobs\SendListMessage;
use App\Jobs\SendSMSMessageDriver;
use App\Jobs\SendSMSMessageUser;
use App\Models\General\NewsLetter;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewsLetterListener
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
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        $newsLetters = NewsLetter::pending()->with('users:mobile', 'drivers:mobile')->get();

        foreach ($newsLetters as $newsLetter) {
            $newsLetter->sending();

            $usersMobile = collect($newsLetter->users)->pluck('mobile')->toArray();
            if (count($usersMobile) > 0) {

                SendListMessage::dispatch($usersMobile, $newsLetter->message)
                    ->onQueue('send_message_user');

            }
            $driversMobile = collect($newsLetter->drivers)->pluck('mobile')->toArray();

            if (count($driversMobile) > 0) {
                SendListMessage::dispatch($driversMobile, $newsLetter->message)
                    ->onQueue('send_message_user');
            }

            $newsLetter->sent();
        }
    }
}
