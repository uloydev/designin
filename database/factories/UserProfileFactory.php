<?php

/** @var Factory $factory */

use App\UserProfile;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(UserProfile::class, function (Faker $faker) {
    static $number = 1;
    return [
        'handphone' => $faker->e164PhoneNumber,
        'address' => $faker->address,
        'bank' => $faker->numberBetween($min = 2, $max = 4),
        'account_number' => $faker->creditCardNumber,
        'avatar' => $faker->randomElement(['files/men.jpg', 'files/people.webp', 'files/flat-boy.jpg']),
        'user_id' => $number++
    ];
});
