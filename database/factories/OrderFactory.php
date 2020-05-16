<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use App\User;
use App\Package;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

$factory->define(Order::class, function (Faker $faker) {
    $users_id = User::where('role', 'user')->pluck('id')->all();
    $agents_id = User::where('role', 'agent')->pluck('id')->all();
    $packages_id = Package::pluck('id')->all();
    $status = $faker->randomElement(['unpaid', 'waiting', 'process', 'complaint', 'finished']);
    $data = [
        'user_id' => $faker->randomElement($users_id),
        'package_id' => $faker->randomElement($packages_id),
        'status' => $status
    ];
    if ($status != 'unpaid' && $status != 'waiting') {
        $data['agent_id'] = $faker->randomElement($agents_id);
        $data['started_at'] = Carbon::now();
        $data['deadline'] = Carbon::now()->addDays(3);
        $data['request'] = $faker->sentence($nbWords = 30, $variableNbWords = true);
        $data['progress'] = $status == 'process' ? $faker->numberBetween(0,100) : 100;
    }
    return $data;
});
