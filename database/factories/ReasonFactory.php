<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reason;
use Faker\Generator as Faker;

$factory->define(Reason::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'description' => $faker->paragraph($nbSentences = 8, $variableNbSentences = true),
    ];
});
