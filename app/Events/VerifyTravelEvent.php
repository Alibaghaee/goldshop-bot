<?php

namespace App\Events;

use App\Models\General\Travel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VerifyTravelEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Travel
     */
    public $travel;
    /**
     * @var int
     */
    public $price;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Travel $travel,int $price)
    {
        $this->travel = $travel;
        $this->price = $price;
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
