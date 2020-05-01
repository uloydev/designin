<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Blog;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'header_image' => 'article3.jpg',
        'contents' => $faker->paragraph($nbSentences = 6, $variableNbSentences = true),
        'author_id' => 1,
        'category_id' => $faker->numberBetween(1, 2),
        'hits' => $faker->numberBetween($min = 1, $max = 200),
    ];
});
