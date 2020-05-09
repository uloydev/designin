<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $table = 'service_category';
    protected $fillable = ['name', 'image_url'];

    public function services()
    {
        return $this->hasMany('App\Service', 'service_category_id', 'id');
    }
}
