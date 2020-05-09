<?php

/** @var Factory $factory */

use App\MetaSeo;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(MetaSeo::class, function (Faker $faker) {
    return [
        'name' => $faker->name($gender = 'male'|'female'),
        'value' => $faker->sentence($nbWords = 3, $variableNbWords = true)
    ];
});
