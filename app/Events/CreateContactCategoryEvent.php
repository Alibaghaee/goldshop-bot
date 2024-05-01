<?php

namespace App\Events;

use App\Models\General\ContactCategory;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CreateContactCategoryEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public ContactCategory $contactCategory;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ContactCategory $contactCategory)
    {
        $this->contactCategory = $contactCategory;
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
