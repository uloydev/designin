<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ServiceExtras;
use Faker\Generator as Faker;
use App\Service;

$factory->define(ServiceExtras::class, function (Faker $faker) {
    return [
        'name'=> $faker->sentence($nbWords=6),
        'service_id'=> $faker->randomElement(Service::pluck('id')->all()),
        'price'=> 100000,
        'description'=> $faker->paragraph($nbSentences=4),
        'benefit'=>json_encode(['duration'=>-2])
    ];
});
