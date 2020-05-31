<?php

/** @var Factory $factory */

use App\Client;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => 'Danone',
        'logo' => 'public/files/danone.svg',
        'is_show' => $faker->boolean($chanceOfGettingTrue = 10),
        'created_at' => now()
    ];
});
