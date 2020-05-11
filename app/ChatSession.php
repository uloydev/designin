<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatSession extends Model
{
    protected $fillable = ['user_id', 'agent_id', 'blocked'];

    public function messages()
    {
        return $this->hasMany('App\Message', 'session_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function agent()
    {
        return $this->belongsTo('App\User', 'agent_id');
    }
}
