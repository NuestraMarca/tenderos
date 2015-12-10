<?php

namespace Tenderos\Events;

use Tenderos\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Tenderos\Entities\User;

class TestPusherEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $text;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($text, User $user)
    {
        $this->text = $text;
        $this->user = $user;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['test-channel'];
    }
}
