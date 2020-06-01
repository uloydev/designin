<?php

/** @var Factory $factory */

use App\UserPortfolio;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(UserPortfolio::class, function (Faker $faker) {
    static $number = 1;
    return [
        'title' =>  'portfolio ' . $number++,
        'image_url' => '/img/cover.jpg',
        'user_id' => $faker->numberBetween($min = 2, $max = 4)
    ];
});
