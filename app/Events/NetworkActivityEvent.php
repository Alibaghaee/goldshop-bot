<?php

namespace App\Events;

use App\Models\General\Admin;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NetworkActivityEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var object
     */
    public $model;
    /**
     * @var Admin
     */
    public $admin;
    /**
     * @var string
     */
    public $title;

    /**
     * Create a new event instance.
     * @param object $model
     * @param Admin $admin
     * @return void
     */
    public function __construct($model, Admin $admin,string $title='none')
    {

        $this->model = $model;
        $this->admin = $admin;
        $this->title = $title;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
