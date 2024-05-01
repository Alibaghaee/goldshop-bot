<?php

namespace App\Listeners;

use App\Events\ReceiveStoreEvent;
use App\Jobs\AnalyzeInbox;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReceiveStoreListener
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
     * @param ReceiveStoreEvent $event
     * @return void
     */
    public function handle($event)
    {

        $response = receiveInbox()->getData();


        if ((!(isset($response->error) && $response->error === 'is_soap_fault')) && count($response->response) > 0) {


            AnalyzeInbox::dispatch(collect($response->response))->onQueue('analyze_inbox');


            collect($response->response)->each(function ($item) {
                smsChangeToRead($item->id);
            });
        }
    }
}
