<?php

/** @var Factory $factory */

use App\UserProfile;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(UserProfile::class, function (Faker $faker) {
    static $number = 1;
    $listBank = json_decode(public_path('js/bank_indonesia.json'));
    return [
        'handphone' => $faker->e164PhoneNumber,
        'address' => $faker->address,
        'bank' => $faker->randomElement([$listBank]),
        'account_number' => $faker->creditCardNumber,
        'avatar' => $faker->randomElement(['files/men.jpg', 'files/people.webp', 'files/flat-boy.jpg']),
        'user_id' => $number++
    ];
});
