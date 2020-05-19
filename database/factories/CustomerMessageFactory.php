<?php

/** @var Factory $factory */

use App\ContactUs;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(ContactUs::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'message' => $faker->paragraph($nbWords = 20, $variableNbWords = true),
        'is_answered' => $faker->boolean($chanceOfGettingTrue = 50)
    ];
});
