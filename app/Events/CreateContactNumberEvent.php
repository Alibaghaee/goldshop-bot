<?php

namespace App\Events;

use App\Models\General\ContactNumber;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CreateContactNumberEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public ContactNumber $contactNumber;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ContactNumber $contactNumber)
    {
        $this->contactNumber = $contactNumber;
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
