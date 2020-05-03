<?php

use Illuminate\Database\Seeder;
use App\Blog;

class BlogSeeder extends Seeder {
    public function run() {
        factory(Blog::class, 30)->create()->each(function ($blog) {
            $blog->make();
        });
    }
}
