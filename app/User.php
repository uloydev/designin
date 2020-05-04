<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail

{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'is_subscribe'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];

    public function service(){
        return $this->hasMany('App\Service', 'agent_id');
    }

    public function profile(){
        return $this->belongsTo('App\UserProfile', 'id', 'user_id');
    }
}
