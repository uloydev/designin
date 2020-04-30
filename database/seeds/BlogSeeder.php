<?php

use Illuminate\Database\Seeder;
use App\Blog;
use App\User;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Blog::class, 30)->create()->each(function ($blog) {
            $blog->make();
        });
    }
}
