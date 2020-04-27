<?php

use Illuminate\Database\Seeder;
use App\BlogCategory;

class BlogCategorySeeder extends Seeder
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
                'name'=>'News'
            ],
            [
                'name'=>'Promo'
            ],
        ];
        foreach ($categories as $key => $value) {
            BlogCategory::create($value);
        }
    }
}
