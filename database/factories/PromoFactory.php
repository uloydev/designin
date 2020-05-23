<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Promo;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

$factory->define(Promo::class, function (Faker $faker) {
    $code = $faker->asciify('********');
    while(Promo::where('code', $code)->count() > 0){
        $code = $faker->asciify('********');
    }
    return [
        'name' => $faker->sentence($nbWords=4, $variableNbWords=true),
        'started_at' => Carbon::now(),
        'ended_at' => Carbon::now()->addDays(10),
        'code' => $code,
        'discount' => $faker->numberBetween(5,10),
        'limit' => $faker->numberBetween(10, 30),
        'usage' => $faker->numberBetween(5, 15)
    ];
});
