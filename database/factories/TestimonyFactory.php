<?php

/** @var Factory $factory */

use App\Testimony;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Testimony::class, function (Faker $faker) {
    return [
        'content' => $faker->sentence($nbWords = 25, $variableNbWords = true),
        'rating'=> $faker->numberBetween(0,5),
        'user_id' => $faker->numberBetween(1, 2),
        'service_id' => 1,
        'is_main' => $faker->boolean($chanceOfGettingTrue = 50)
    ];
});
