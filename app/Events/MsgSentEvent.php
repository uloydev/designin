<?php

namespace App\Events;

use App\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MsgSentEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $session;

    /**
     * Create a new event instance.
     *
     * @param $message
     * @param $session
     */
    public function __construct($message, $session)
    {
        $this->message = $message;
        $this->session = $session;
        $this->dontBroadcastToCurrentUser();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat'.$this->session->id);
    }
}
