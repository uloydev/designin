<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    protected $fillable = ['content', 'sender_id', 'order_id', 'is_read'];
//    protected $with = ['sender'];

    public function sender()
    {
        return $this->belongsTo('App\User', 'sender_id');
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
