<?php

namespace App\Mail;


use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Confirmation extends Mailable
{
    use Queueable, SerializesModels;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
	public $name;
	public $code;
	public $email;
	public function __construct($name, $code, $email){
		$this->name = $name;
		$this->code = $code;
		$this->email = $email;
	}
	
    public function build(){
		//$data['name']
		return $this->from('no-reply@collabup.com', 'CollabUp')->view('mail.confirmation');
	}
}
