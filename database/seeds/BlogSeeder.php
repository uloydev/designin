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
        $author_name = User::where('role', 'admin')->first()->name;
        $blogs = [
            [
                'title'=>'title 1',
                'content'=>'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestias omnis assumenda amet debitis tenetur consequuntur sed cumque possimus ducimus quae. Expedita consectetur sit amet? Eveniet fuga blanditiis quos maiores est?',
                'author'=>$author_name,
                'category'=>'news'
            ],
            [
                'title'=> 'title 2',
                'header_image'=>'https://cdn.pixabay.com/photo/2019/10/04/18/36/milky-way-4526277_960_720.jpg',
                'content' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestias omnis assumenda amet debitis tenetur consequuntur sed cumque possimus ducimus quae. Expedita consectetur sit amet? Eveniet fuga blanditiis quos maiores est?',
                'author'=>$author_name,
                'category'=>'blog'
            ],
            [
                'title'=>'title 3',
                'content'=>'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestias omnis assumenda amet debitis tenetur consequuntur sed cumque possimus ducimus quae. Expedita consectetur sit amet? Eveniet fuga blanditiis quos maiores est?',
                'author'=>$author_name,
                'category'=>'promo'
                
            ],
            [
                'title'=> 'title 4',
                'header_image'=>'https://cdn.pixabay.com/photo/2013/11/28/10/36/road-220058_960_720.jpg',
                'content' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestias omnis assumenda amet debitis tenetur consequuntur sed cumque possimus ducimus quae. Expedita consectetur sit amet? Eveniet fuga blanditiis quos maiores est?',
                'author'=>$author_name,
                'category'=>'blog'
            ],
        ];
        foreach ($blogs as $key => $value) {
            Blog::create($value);
        }
    }
}
