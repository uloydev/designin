<?php

/** @var Factory $factory */

use App\Order;
use App\User;
use App\Package;
use App\Service;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Carbon;

$factory->define(Order::class, function (Faker $faker) {
    $agent_id = User::inRandomOrder()->firstWhere('role', 'agent')->id;
    $package = Package::inRandomOrder()->firstWhere('service_id', Service::inRandomOrder()->firstWhere('agent_id', $agent_id)->id);
    $status = $faker->randomElement(['process', 'complaint', 'finished']);
    $data = [
        'user_id' => User::inRandomOrder()->firstWhere('role', 'user')->id,
        'package_id' => $package->id,
        'status' => $status,
        'agent_id' => $agent_id,
        'request' => $faker->paragraph($nbSentences = 20, $variableNbSentences = true),
        'budget' => $package->price,
        'quantity' => $faker->numberBetween(1,4),
        'max_revision' => $faker->numberBetween(1,3),
    ];
    if ($status != 'unpaid' and $status != 'waiting') {
        $data['started_at'] = Carbon::now();
        $data['deadline'] = Carbon::now()->addDays(3);
        $data['progress'] = $status == 'process' ? $faker->numberBetween(0, 90) : 100;
    }
    return $data;
});
