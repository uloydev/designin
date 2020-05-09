<?php

/** @var Factory $factory */

use App\Faq;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Faq::class, function (Faker $faker) {
    return [
        'question' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'answer' => $faker->paragraph($nbSentences = 8, $variableNbSentences = true),
        'faq_category_id' => $faker->numberBetween(1, 2)
    ];
});
