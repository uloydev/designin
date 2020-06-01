<?php

/** @var Factory $factory */

use App\Service;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'is_popular' => $faker->boolean($chanceOfGettingTrue = 13),
        'title' => 'Design ' . $faker->sentence($nbWords = 3, $variableNbWords = true),
        'description' => '<h1>It Kind Stars Wherein</h1>
            <p>After Shall Their Darkness Green Sea Their</p>
            <p>Greater man make sea made together created. Air man gathering bring were man.</p>

            <p>Two Replenish Day Them Beginning In Bearing</p>
            <p>Over don&#39;t, void lesser was fowl seasons divide fish. Gathered. All move itself may,
            upon he together days. Open. Land face.</p>

            <p>Green Two Seed Form</p>
            <p>A life they&#39;re two blessed made man waters seasons creeping subdue Sea beast behold great.</p>

            <p>Of, creepy male him they&#39;re you fish air together meat night darkness whales shall.
            Creature thing living signs make male over yielding set the. So. Without face, moving light.</p>

            <p>Is let brought. God life, fowl. Good without created a us good cattle creeping very evening.
            So can&#39;t fish us the sea.</p>',
        'image' => $faker->randomElement(['files/service-design2.jpg', 'files/service-vector.jpg']),
        'agent_id' => $faker->numberBetween(2, 3),
        'service_category_id' => $faker->numberBetween(1, 6)
    ];
});
