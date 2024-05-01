<?php

namespace App\Listeners;

use App\Events\NetworkActivityEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NetworkActivityListener
{

    /**
     * Handle the event.
     *
     * @param NetworkActivityEvent $event
     * @return void
     */
    public function handle(NetworkActivityEvent $event)
    {
        if (!$event->admin->profile()->exists()){

            $event->admin->profile()->create();
        }
       $id= $event->admin->profile
            ->networkActivities()
            ->create([
                'title' => $event->title,
                'network_activitiable_type' => get_class($event->model),
                'network_activitiable_id' => $event->model->id,
            ])->id;

        $event->model->createCloneLog($id);
    }
}
