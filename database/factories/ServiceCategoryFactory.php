<?php

/** @var Factory $factory */

use App\ServiceCategory;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(ServiceCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->randomElement([
            'Logo', 'Social Media', 'Packaging', 'Pattern / Hijab', 'T-Shirt', 'Poster', 'Brosur'
        ]),
        'image_url' => $faker->unique()->randomElement([
            'files/logo-category.svg',
            'files/sosmed-category.svg',
            'files/packaging-category.svg',
            'files/pattern-category.svg',
            'files/tshirt-category.svg',
            'files/poster-category.svg',
            'files/brochure-category.svg'
        ])
    ];
});
