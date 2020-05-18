<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'agent_id',
        'package_id', 
        'started_at', 
        'status', 
        'progress', 
        'request', 
        'deadline', 
        'is_reviewed'];
    protected $casts = ['start_at'=> 'datetime', 'deadline'=>'datetime'];
    // protected $with = ['package'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function agent()
    {
        return $this->belongsTo('App\User', 'agent_id');
    }

    public function package()
    {
        return $this->belongsTo('App\Package');
    }
}
