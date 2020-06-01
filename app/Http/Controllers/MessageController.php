<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\ChatSession;
use App\Events\MsgSentEvent;
use Illuminate\Support\Facades\Route;

class MessageController extends Controller
{
    public function index()
    {
        return view('message', ['sessions'=>Auth::user()->chatSession]);
    }


    public function fetch($session_id)
    {
        $user = Auth::user();
        $session = ChatSession::where($user->role.'_id', $user->id)->findOrFail($session_id);
        $messages = Message::where('session_id', $session_id)->get();
        return ['user_id'=> $user->id ,'messages'=> $messages];
    }

    public function send(Request $request, $session_id)
    {
        $user = Auth::user();
        $session = ChatSession::where($user->role.'_id', $user->id)->findOrFail($session_id);
        $message = Message::create([
            'content' => $request->content,
            'sender_id' => Auth::id(),
            'session_id' => $session_id
        ]);
        $message = Message::find($message->id); // refreshing model to get sender
        Broadcast(new MsgSentEvent($message, $session));
        return ['status'=> 'ok', 'message'=> $message];
    }

    public function chat($id)
    {
        $order = Order::findOrFail($id);
        $messages = Message::with('sender.profile')->where('order_id', $id)->get();
        if (Auth::user()->role == 'agent') {
            Message::where('order_id', $id)->whereHas('sender', function (Builder $query) {
                $query->where('role', 'user');
            })->update(['is_read' => true]);
        }
        else {
            Message::where('order_id', $id)->whereHas('sender', function (Builder $query) {
                $query->where('role', 'agent');
            })->update(['is_read' => true]);
        }
        return view('job.chat', ['order' => $order, 'messages' => $messages]);
    }

    public function getChat($id){
        $order = Order::findOrFail($id);
        $messages = Message::with('sender.profile')->where('order_id', $id)->get();
        if (Auth::user()->role == 'agent') {
            Message::where('order_id', $id)->whereHas('sender', function (Builder $query) {
                $query->where('role', 'user');
            })->update(['is_read' => true]);
        }
        else {
            Message::where('order_id', $id)->whereHas('sender', function (Builder $query) {
                $query->where('role', 'agent');
            })->update(['is_read' => true]);
        }

        return view('job.listChat', ['order' => $order, 'messages' => $messages]);
    }

    public function sendChat(Request $request)
    {
        $chat = new Message;
        $chat->content = strval($request->message);
        $chat->order_id = $request->order_id;
        $chat->sender_id = intval($request->sender_id);
        $chat->save();
    }
}
