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

    //custom method
    public static function getMessage($id = 0){

        if ($id == 0) {
            $value = DB::table('messages')->orderBy('id', 'asc')->get();
        }
        else {
            $value = DB::table('messages')->where('id', $id)->first();
        }
        return $value;

    }
}
