<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['question', 'answer'];

    public function faqCategory()
    {
      return $this->belongsTo('App\FaqCategory');
    }
}
