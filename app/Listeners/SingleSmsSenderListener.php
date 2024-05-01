<?php

namespace App\Listeners;

use App\Events\SingleSmsSenderEvent;
use App\Jobs\SingleSmsSenderJob;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SingleSmsSenderListener
{


    /**
     * Handle the event.
     *
     * @param SingleSmsSenderEvent $event
     * @return void
     */
    public function handle($event)
    {
        SingleSmsSenderJob::dispatch($event->singleSms)->onQueue('single_sms_sender');
    }
}
