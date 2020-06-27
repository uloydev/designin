<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\SubscriptionOrder;

class UserSubscriptionNotification extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $order;

    public function __construct(User $user, SubscriptionOrder $order)
    {
        $this->user = $user;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('subscription accepted')->markdown('emails.subscription')->with([
            'user' => $this->user,
            'order' => $this->order
        ]);
    }
}
