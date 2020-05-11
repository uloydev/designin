<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use App\User;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    $agents = User::where('role', 'agent')->pluck('id')->all();
    $users = User::where('role', 'user')->pluck('id')->all();
    $sender = $faker->randomElement(array_merge($agents, $users));
    do {
        $receiver = $faker->randomElement(array_merge($agents, $users));
    } while ($sender == $receiver);
    return [
        'content'=> $faker->sentence($nbWords = 10, $variableNbWords = true),
        'sender_id'=> $sender,
        'receiver_id'=> $receiver
    ];
});
