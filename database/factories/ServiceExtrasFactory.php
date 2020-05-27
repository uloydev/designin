<?php

/** @var Factory $factory */

use App\ServiceExtras;
use Faker\Generator as Faker;
use App\Service;
use Illuminate\Database\Eloquent\Factory;

$factory->define(ServiceExtras::class, function (Faker $faker) {
    return [
        'name'=> $faker->sentence($nbWords = 6),
        'service_id'=> $faker->randomElement(Service::pluck('id')->all()),
        'price'=> $faker->numberBetween($min = 10000, $max = 50000),
        'price_token'=> $faker->numberBetween($min = 10, $max = 50),
        'description'=> $faker->paragraph($nbSentences = 4)
    ];
});
