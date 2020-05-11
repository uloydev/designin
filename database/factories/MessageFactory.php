<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use App\User;
use App\ChatSession;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    $session = $faker->randomElement(ChatSession::all());
    return [
        'content'=> $faker->sentence($nbWords = 10, $variableNbWords = true),
        'sender_id'=> $faker->randomElement([$session->user_id, $session->agent_id]),
        'session_id'=> $session->id
    ];
});
