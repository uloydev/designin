<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\Service;

class ContactAgentNotification extends Mailable
{
    use Queueable, SerializesModels;

    private $requestData;
    private $user;
    private $service;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($requestData, User $user, Service $service)
    {
        $this->requestData = $requestData;
        $this->user = $user;
        $this->service = $service;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contact-agent')->with([
            'requestData' => $this->requestData,
            'user' => $this->user,
            'service' => $this->service,
        ]);
    }
}
