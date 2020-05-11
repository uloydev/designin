<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => 4,
        'agent_id' => 2,
        'service_id' => 1,
        'status' => $faker->randomElement(['unpaid', 'waiting', 'proccess', 'complaint', 'finished'])
    ];
});
