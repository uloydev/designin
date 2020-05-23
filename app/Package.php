<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'package';
    protected $fillable = [
        'title', 'description', 'price', 'service_id', 'duration', 'token_price'
    ];

    public function service()
    {
        return $this->belongsTo('App\Service');
    }
}
