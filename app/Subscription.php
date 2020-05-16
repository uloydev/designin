<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscription';
    protected $fillable = ['title', 'desc', 'img', 'token'];

    public function subscribers()
    {
        return $this->hasMany('App\User', 'subscribe_to');
    }
}
