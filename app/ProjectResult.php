<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectResult extends Model
{
    protected $fillable = ['file', 'message', 'type', 'order_id', 'agent_id'];


    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function agent()
    {
        return $this->belongsTo('App\User', 'agent_id');
    }
}
