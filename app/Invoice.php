<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'payment_token',
        'payment_status_code',
        'payment_status',
        'order_id',
        'payment_type'
    ];

    public function order()
    {
        return $this->belongsTo('App\Order');
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
