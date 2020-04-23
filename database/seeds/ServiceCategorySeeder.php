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
            ],
            [
                'name' => 'Category 2',
            ],
            [
                'name' => 'Category 3',
            ],
        ];
        foreach ($categories as $key => $value) {
            ServiceCategori::create($value);
        }
    }
}
