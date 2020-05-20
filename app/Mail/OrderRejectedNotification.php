<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Order;

class OrderRejectedNotification extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    public function __construct(Order $data)
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
        return $this->subject($this->package->title)
                    ->markdown('emails.approval-order')
                    ->with('data', $this->data);
    }
}
