<?php

use Illuminate\Database\Seeder;
use App\ServiceCategory;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Logo',
                'image_url' => 'files/logo-category.svg'
            ],
            [
                'name' => 'Social Media',
                'image_url' => 'files/sosmed-category.svg'
            ],
            [
                'name' => 'Packaging',
                'image_url' => 'files/packaging-category.svg'
            ],
            [
                'name' => 'Pattern / Hijab',
                'image_url' => 'files/pattern-category.svg'
            ],
            [
                'name' => 'T-Shirt',
                'image_url' => 'files/tshirt-category.svg'
            ],
            [
                'name' => 'Poster',
                'image_url' => 'files/poster-category.svg'
            ],
            [
                'name' => 'Brosur',
                'image_url' => 'files/brochure-category.svg'
            ]
        ];
        foreach ($categories as $key => $value) {
            ServiceCategory::create($value);
        }
    }
}
