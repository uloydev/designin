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

    public function __construct(Order $order, ProjectResult $revision)
    {
        $this->order = $order;
        $this->revision = $revision;
    }

    public function build()
    {
        return $this->subject('Revision Result')->markdown('emails.send-revision')->with([
            'order' => $this->order,
            'revision' => $this->revision,
        ]);
    }
}
