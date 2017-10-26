<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewPost extends Notification implements ShouldQueue
{
    use Queueable;
	  public $group;
    public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($group,$user)
    {
      
	  $this->group = $group;
       $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line($this->user->username.' added a new post on '.$this->group->group_name)
                    ->action('View post', '/group/'.$this->group->id)
                    ->line('Thank you for using CollabUp!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
	'image' => $this->user->image,	
   'name' => $this->user->username,
   'message' =>' added a new post on '.$this->group->group_name
        ];
    }
    // $this->users->username .

}
