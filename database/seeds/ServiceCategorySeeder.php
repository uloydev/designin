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
                'name' => 'Category 1',
                'image_url' => 'files/t-shirt.png'
            ],
            [
                'name' => 'Category 2',
                'image_url' => 'files/t-shirt.png'
            ],
            [
                'name' => 'Category 3',
                'image_url' => 'files/t-shirt.png'
            ],
            [
                'name' => 'Category 4',
                'image_url' => 'files/t-shirt.png'
            ],
            [
                'name' => 'Category 5',
                'image_url' => 'files/t-shirt.png'
            ],
            [
                'name' => 'Category 6',
                'image_url' => 'files/t-shirt.png'
            ]
        ];
        foreach ($categories as $key => $value) {
            ServiceCategory::create($value);
        }
    }
}
