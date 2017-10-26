<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendForgetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $code;
    public $id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$code, $token)
    {
        $this->email = $email;
        $this->code = $code;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data['email'] =$this->email;
        $data['code'] = $this->code;
        $data['token'] = $this->token;
        return $this->view('mail.forget', $data);
    }
}
