<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $fillable = ['name', 'email', 'message', 'answer', 'is_answered', 'admin_id'];

    public function admin()
    {
        return $this->belongsTo('App\User', 'admin_id');
    }
}
