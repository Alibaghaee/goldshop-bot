<?php

namespace App\Listeners;

use App\Jobs\GroupSmsSenderJob;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\GroupSmsSenderEvent;

class GroupSmsSenderListener
{


    /**
     * Handle the event.
     *
     * @param GroupSmsSenderEvent $event
     * @return void
     */
    public function handle($event)
    {

        GroupSmsSenderJob::dispatch($event->groupSmsSender)->onQueue('group_sms_sender');

    }
}
