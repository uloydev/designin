<?php

/** @var Factory $factory */

use App\Message;
use App\User;
use App\ChatSession;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Message::class, function (Faker $faker) {
    $session = $faker->randomElement(ChatSession::all());
    return [
        'content'=> $faker->sentence($nbWords = 10, $variableNbWords = true),
        'sender_id'=> $faker->randomElement([$session->user_id, $session->agent_id]),
        'order_id' => $faker->numberBetween($min = 1, $max = 100),
//        'session_id'=> $session->id
    ];
});
