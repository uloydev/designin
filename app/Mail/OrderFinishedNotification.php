<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\ProjectResult;
use App\Order;

class OrderFinishedNotification extends Mailable
{
    use Queueable, SerializesModels;

    private $order;
    private $result;

    public function __construct(Order $order, ProjectResult $result)
    {
        $this->order = $order;
        $this->result = $result;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Result for your order')->markdown('emails.order-finished', [
            'order' => $this->order,
            'result' => $this->result,
        ])->attachFromStorage($this->result->file);
    }
}
