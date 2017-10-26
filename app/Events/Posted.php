<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
//use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Posted implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;
public $username;
public $message;
public $groupname;
public $type;
public $avatar;
public $id;
public $link;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($username,$type,$groupname,$id,$link)
    {
        //5 parameters name, post type, group name, group id, and url 
        $this->username = $username;
        $this->groupname = $groupname;
        $this->type = $type;
        $this->id = $id;
        $this->link = $link;
        if($type == 1){
$this->message = "{$username} posted on {$groupname}";
        }elseif($type == 2){
$this->message = "{$username} posted an Event on {$groupname}";
        }elseif($type == 3){
$this->message = "{$username} posted an Announcement ";
        }else{
            $this->message = "Something went wrong ";
        }

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return ['posted-'.$this->id];
    }
}
