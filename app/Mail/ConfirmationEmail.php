<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = env('MAIL_FROM_ADDRESS');
        $subject = 'Confirmation Email';
        $name = env('APP_NAME');
        
        return $this->view('emails.confirmationEmail')
                    ->from($address, $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    ->with($this->data);
    }
}
