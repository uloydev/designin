<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog';
    protected $with = ['category'];
    protected $fillable = ['title', 'header_image', 'contents', 'author_id', 'category_id', 'hits'];

    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    public function category()
    {
        return $this->belongsTo('App\BlogCategory', 'category_id');
    }
}
