<?php

/** @var Factory $factory */

use App\Blog;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Blog::class, function (Faker $faker) {
    $cover = ['temporary/interest1.jpg', 'files/promo1.webp'];
    return [
        'title' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'header_image' => 'public/temporary/article3.jpg',
        'cover' => $cover[$faker->numberBetween(0, 1)],
        'contents' =>   $faker->sentence($nbWords = 200, $variableNbWords = true),
        'author_id' => 1,
        'is_main' => $faker->boolean($chanceOfGettingTrue = 10),
        'category_id' => $faker->numberBetween(1, 2),
        'hits' => $faker->numberBetween($min = 1, $max = 200),
    ];
});
