<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
//use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AnnouncementPosted implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->message = "New Announcement";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return ['announcementposted'];
    }
}
