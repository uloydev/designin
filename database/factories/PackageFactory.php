<?php

/** @var Factory $factory */

use App\Package;
use App\Model;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Package::class, function (Faker $faker) {
    $title = ['basic', 'medium', 'pro'];
    return [
        'title' => $title[$faker->numberBetween($min = 0, $max = 2)],
        'description' => $faker->paragraph($nbSentences = 5, $variableNbSentences = true),
        'price' =>   $faker->unique(true)->numberBetween($min = 100000, $max = 3000000),
        'service_id' => $faker->unique()->numberBetween($min = 1, $max = 30),
        'duration' => $faker->numberBetween($min = 10, $max = 30),
        'token_price' => 10
    ];
});
