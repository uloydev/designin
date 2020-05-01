<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog';
    protected $with = ['category'];
    protected $fillable = ['title', 'header_image', 'content', 'author_id', 'category_id', 'hits', 'is_main'];

    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    public function category()
    {
        return $this->belongsTo('App\BlogCategory', 'category_id');
    }
}
