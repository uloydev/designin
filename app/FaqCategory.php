<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{

  protected $table = 'faq_category';
  protected $fillable = ['category'];

  public function faqs()
  {
      return $this->hasMany('App\Faq');
  }
}
