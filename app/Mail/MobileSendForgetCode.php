<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MobileSendForgetCode extends Mailable
{
    use Queueable, SerializesModels;
	public $email;
	public $ip_add;
	public $code;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $code)
    {
    $this->email = $email;
	$this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		$data["email"] = $this->email;
		$data["code"] = $this->code;
        return $this->view('mail.mobile.forget', $data);
    }
}
