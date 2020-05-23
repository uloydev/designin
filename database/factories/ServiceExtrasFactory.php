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
        'price_token'=> 10,
        'description'=> $faker->paragraph($nbSentences=4),
        'benefit'=>'reduce order duration by 2 days'
    ];
});
