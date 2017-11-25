<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendAppNotification implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $user_id;
    public $reciever_id;
    public $ref;
    public $group_id;
    public $type;
//Type if type = 1 - Post 2 - Event. 3 - File Upload - 4 Announcement. 5 - 
//Group Request 6 - Accepted Request 7 - Declined Request 
// 8 - Created Folder
/**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user_id, $reciever_id,$ref,$group_id, $type)
    {
        $this->user_id = $user_id;
        $this->reciever_id = $reciever_id;
        $this->ref = $ref;
        $this->group_id = $group_id;
        $this->type = $type;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return [$this->reciever_id];
    }
}
