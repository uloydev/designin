<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Order;
use App\ProjectResult;

class OrderRevisionFinishedNotification extends Mailable
{
    use Queueable, SerializesModels;

    private $order;
    private $revision;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, ProjectResult $revision)
    {
        $this->order = $order;
        $this->revision = $revision;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.order.revision-finished', [
            'order' => $this->order,
            'revision' => $this->revision,
        ]);
    }
}
