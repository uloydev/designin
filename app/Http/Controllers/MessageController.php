<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\ChatSession;
use App\Events\MsgSentEvent;

class MessageController extends Controller
{
    public function index()
    {
        return view('message', ['sessions'=>Auth::user()->chatSession]);
    }

    /**
     * fetch function
     *
     * @param $user_id
     * @return Message
     */
    public function fetch($session_id)
    {
        $user = Auth::user();
        $session = ChatSession::where($user->role.'_id', $user->id)->findOrFail($session_id);
        $messages = Message::where('session_id', $session_id)->get();
        return ['user_id'=> $user->id ,'messages'=> $messages];
    }

    /**
     * send function
     *
     * @param Request $request
     * @param [Integer] $user_id
     * @return Message
     */
    public function send(Request $request, $session_id)
    {
        $user = Auth::user();
        $session = ChatSession::where($user->role.'_id', $user->id)->findOrFail($session_id);
        $message = Message::create([
            'content' => $request->content,
            'sender_id' => Auth::id(),
            'session_id' => $session_id 
        ]);
        $message = Message::find($message->id); // refreshing model to get serner
        Broadcast(new MsgSentEvent($message, $session));
        return ['status'=> 'ok', 'message'=> $message];
    }
}
