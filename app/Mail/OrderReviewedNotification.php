<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Order;
use Illuminate\Http\Request;

class OrderReviewedNotification extends Mailable
{
    use Queueable, SerializesModels;

    private $data;
    public $message;

    public function __construct(Order $data, Request $request)
    {
        $this->data = $data;
        $this->message = $request->rating_review;
    }

    public function build()
    {
        return $this->subject('Review from our agent')
                    ->markdown('emails.review-history')
                    ->with([
                        'data' => $this->data,
                        'message' => $this->message
                    ]);
    }
}
