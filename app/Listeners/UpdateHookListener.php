<?php

namespace App\Listeners;

use App\Events\UpdateHookEvent;
use App\Jobs\ProcessUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateHookListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UpdateHookEvent $event): void
    {
        if (!is_null($event->updates->get('update_id'))) {

            ProcessUpdated::dispatch($event->updates)->onQueue('processing_updated');
        }
    }
}
