<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TokenConversion extends Model
{
    protected $table = 'token_conversion';
    protected $fillable = ['numeral'];
}
