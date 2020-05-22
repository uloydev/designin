<?php

/** @var Factory $factory */

use App\Client;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'logo' => 'public/temporary/client.png',
        'is_show' => $faker->boolean($chanceOfGettingTrue = 50),
        'created_at' => now()
    ];
});
