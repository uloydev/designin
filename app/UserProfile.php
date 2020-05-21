<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profile';
    protected $fillable = ['avatar', 'handphone', 'address', 'name_card', 'bank', 'account_number', 'user_id'];
    protected $with = ['portfolio', 'user'];

    public function portfolio()
    {
        return $this->hasMany('App\UserPortfolio', 'user_id', 'user_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
