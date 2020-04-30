<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['title', 'header_image', 'content', 'author_id', 'category_id', 'hits'];

    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    public function blogCategory()
    {
        return $this->belongsTo('App\BlogCategory', 'category_id');
    }
}
