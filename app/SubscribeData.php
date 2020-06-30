<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscribeData extends Model
{
    protected $fillable = [
        'user_id',
        'subscription_id',
        'subscribe_at',
        'expired_at',
        'price',
        'token',
        'duration'
    ];

    protected $casts = [
        'subscribe_at' => 'datetime',
        'expired_at' => 'datetime'
    ];

    public function subscription()
    {
        return $this->belongsTo('App\Subscription');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
