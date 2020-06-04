<?php

/** @var Factory $factory */

use App\Blog;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Blog::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'header_image' => $faker->randomElement(['files/article3.jpg', 'files/article1.jpg', 'files/article2.jpg']),
        'cover' => $faker->randomElement(['files/interest1.jpg', 'files/promo1.webp']),
        'contents' => $faker->sentence($nbWords = 200, $variableNbWords = true),
        'is_main' => $faker->boolean($chanceOfGettingTrue = 30),
        'category_id' => $faker->numberBetween(1, 2),
        'hits' => $faker->numberBetween($min = 1, $max = 200),
    ];
});
