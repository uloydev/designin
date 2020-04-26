<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPortfolio extends Model
{
    protected $fillable = ['title', 'image_url', 'user_id'];
}
