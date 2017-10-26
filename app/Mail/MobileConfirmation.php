<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MobileConfirmation extends Mailable
{
    use Queueable, SerializesModels;

	public $code;
	public $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$code)
    {
	$this->code = $code;
    $this->name = $name;
    }

    /**
     * Build the message.
     *	
     * @return $this
     */
    public function build()
    {
		$data['code'] = $this->code;
        $data['name'] = $this->name;
       $this->from('no-reply@collabup.com', 'CollabUp Mobile Confirmation');
        return $this->view('mail.mobile.confirmation', $data);
    }
}
