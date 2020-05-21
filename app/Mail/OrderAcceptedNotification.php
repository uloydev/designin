<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Order;
use Illuminate\Http\Request;

class OrderAcceptedNotification extends Mailable
{
    use Queueable, SerializesModels;


    private $data;

    public function __construct(Order $data)
    {
        $this->data = $data;
    }


    public function build()
    {
        return $this->subject('Desainin ' . $this->data->package->title)
                    ->markdown('emails.approval-order')
                    ->with('data', $this->data);
    }
}
