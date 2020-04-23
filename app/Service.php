<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title', 'description', 'image', 'agent_id', 'category_id'
    ];

    public function package()
    {
        return $this->hasMany('App\Package');
    }

    public function agent()
    {
        return $this->belongsTo('App\User', 'agent_id');
    }
}
