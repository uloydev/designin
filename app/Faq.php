<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faq';
    protected $fillable = ['question', 'answer', 'faq_category_id'];

    public function faqCategory()
    {
      return $this->belongsTo('App\FaqCategory', 'faq_category_id', 'id');
    }
}
