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
        'price'=> 100000,
        'price_token'=> 10,
        'description'=> $faker->paragraph($nbSentences = 4)
    ];
});
