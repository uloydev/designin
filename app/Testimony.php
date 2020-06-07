<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    protected $table = 'testimony';
    protected $fillable = ['content', 'rating', 'service_id', 'user_id', 'is_main'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function service()
    {
        return $this->belongsTo('App\Service');
    }
}
