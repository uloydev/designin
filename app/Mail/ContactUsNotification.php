<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\ContactUs;

class ContactUsNotification extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    public function __construct(ContactUs $data)
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
        return $this->subject('Your message has been replied from Desainin')
                    ->markdown('emails.reply-message')
                    ->with('data', $this->data);
    }
}
