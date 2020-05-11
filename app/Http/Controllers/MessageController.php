<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    public function fetch(Request $request)
    {
        $sender_id = $request->sender_id;
        $receiver_id = $request->receiver_id;
        $messages = Message::where('sender_id', $sender_id)->andWhere('receiver_id', $receiver_id);
    }

    public function send(Request $request)
    {
        
    }
}
