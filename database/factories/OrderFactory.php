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
    $user_id =$faker->randomElement( User::where('role', 'user')->pluck('id')->all());
    $agent_id = $faker->randomElement( User::where('role', 'agent')->pluck('id')->all());
    $packages = Package::where('service_id', Service::where('agent_id', $agent_id)->first()->id);
    $package_id = $faker->randomElement($packages->pluck('id')->all());
    $status = $faker->randomElement(['unpaid', 'waiting', 'process', 'complaint', 'finished']);
    $price = $packages->inRandomOrder()->first()->price;
    $data = [
        'user_id' => $user_id,
        'package_id' => $package_id,
        'status' => $status,
        'agent_id' => $agent_id,
        'request' => $faker->paragraph($nbSentences = 20, $variableNbSentences = true),
        'budget' => $price,
    ];
    if ($status != 'unpaid' and $status != 'waiting') {
        $data['started_at'] = Carbon::now();
        $data['deadline'] = Carbon::now()->addDays(3);
        $data['progress'] = $status == 'process' ? $faker->numberBetween(0,100) : 100;
    }
    return $data;
});
