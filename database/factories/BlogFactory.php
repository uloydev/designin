<?php

/** @var Factory $factory */

use App\Blog;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Blog::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'header_image' => 'public/files/article3.jpg',
        'contents' =>   $faker->sentence($nbWords = 200, $variableNbWords = true),
        'author_id' => 1,
        'category_id' => $faker->numberBetween(1, 2),
        'hits' => $faker->numberBetween($min = 1, $max = 200),
    ];
});
