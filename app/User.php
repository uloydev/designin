<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'is_subscribe', 'subscribe_to', 'username', 'email_verified_at',
        'subscribe_at', 'subscribe_token', 'subscribe_duration', 'provider_id', 'provider'
    ];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime', 'subscribe_at'=>'datetime'];

    public function service()
    {
        return $this->hasMany('App\Service', 'agent_id');
    }

    public function profile()
    {
        return $this->hasOne('App\UserProfile', 'user_id', 'id');
    }

    public function chatSession()
    {
        if ($this->role != 'admin') {
            return $this->hasMany('App\ChatSession', $this->role.'_id')->where('blocked', 0);
        }
    }

    public function userOrders()
    {
        return $this->hasMany('App\Order', 'user_id');
    }

    public function agentOrders()
    {
        return $this->hasMany('App\Order', 'agent_id');
    }

    public function subscription()
    {
        return $this->hasMany('App\SubscribeData')->where('expired_at', '>', Carbon::now())->orderBy('expired_at', 'ASC');
    }

    public function subscriptionOrder()
    {
        return $this->hasMany('App\SubscriptionOrder');
    }
}
