<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceExtras extends Model
{
    protected $fillable = ['name', 'service_id', 'price', 'price_token', 'description'];

    public function service()
    {
        return $this->belongsTo('App\Service');
    }
}
