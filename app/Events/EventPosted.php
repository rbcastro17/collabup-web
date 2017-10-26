<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
//use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EventPosted implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;
public $username;
public $message;
public $groupname;
public $type;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($username,$type,$groupname)
    {
        $this->username = $username;
        $this->groupname = $groupname;
        $this->type = $type;

        if($type == 1){
$this->message = "{$username} posted on {$groupname}";
        }elseif($type == 2){
$this->message = "{$username} posted an Event on {$groupname}";
        }else{
$this->message = "{$username} posted an Announcement ";
        }

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return ['eventposted'];
    }
}
