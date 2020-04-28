<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'service';
    protected $with = ['category'];
    protected $fillable = [
        'title', 'description', 'image', 'agent_id', 'service_category_id'
    ];

    public function package()
    {
        return $this->hasMany('App\Package');
    }

    public function agent()
    {
        return $this->belongsTo('App\User', 'agent_id')->withDefault();
    }
    public function category()
    {
        return $this->belongsTo('App\ServiceCategory')->withDefault();
    }
}
