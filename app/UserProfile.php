<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = ['avatar', 'handphone', 'name_card', 'bank', 'account_number', 'user_id'];

    public function portfolio()
    {
        return $this->hasMany('App\UserPortfolio', 'user_id', 'user_id');
    }
}
