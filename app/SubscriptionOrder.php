<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionOrder extends Model
{
    protected $fillable = [
        'payment_status',
        'payment_status_code',
        'payment_token',
        'payment_type',
        'quantity',
        'subscription_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function subscription()
    {
        return $this->belongsTo('App\Subscription');
    }

    public function setPending()
    {
        $this->attributes['payment_status'] = 'pending';
        self::save();
    }

    /**
     * Set status to Success
     *
     * @return void
     */
    public function setSuccess()
    {
        $this->attributes['payment_status'] = 'success';
        self::save();
    }

    /**
     * Set status to Failed
     *
     * @return void
     */
    public function setFailed()
    {
        $this->attributes['payment_status'] = 'failed';
        self::save();
    }

    /**
     * Set status to Expired
     *
     * @return void
     */
    public function setExpired()
    {
        $this->attributes['payment_status'] = 'expired';
        self::save();
    }
}
