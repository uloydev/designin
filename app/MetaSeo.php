<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetaSeo extends Model
{
    protected $table = 'meta_seo';
    protected $fillable = ['name', 'value'];
}
