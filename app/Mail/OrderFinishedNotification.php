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
    /**
     * Create a new message instance.
     *
     * @return void
     */
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
        return $this->view('emails.order.finished', [
            'order' => $this->order,
            'result' => $this->result,
        ]);
    }
}
