<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    protected $fillable = ['content', 'sender_id', 'session_id'];
    protected $with = ['sender'];

    public function sender()
    {
        return $this->belongsTo('App\User', 'sender_id')->with('profile:avatar');
    }

    public function session()
    {
        return $this->belongsTo('App\ChatSession');
    }

    public function receiver()
    {
        return $this->session->belongsTo('App\User', Auth::user()->role.'_id');
    }
}
