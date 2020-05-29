<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ServiceExtras;

class Service extends Model
{
    protected $table = 'service';
    protected $with = ['serviceCategory', 'agent', 'testimonies'];
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

    public function serviceCategory()
    {
        return $this->belongsTo('App\ServiceCategory');
    }

    public function testimonies()
    {
        return $this->hasMany('App\Testimony');
    }

    public function extras()
    {
        return $this->hasMany('App\ServiceExtras');
    }

    // public function extras_template()
    // {
    //     return ServiceExtras::where('is_template', true)->get();
    // }
}
