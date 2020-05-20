<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = ['name', 'started_at', 'ended_at'. 'code', 'discount', 'limit'];
    protected $casts = ['started_at'=>'datetime', 'ended_at'=>'datetime'];
}
