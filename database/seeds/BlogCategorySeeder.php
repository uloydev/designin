<?php

use Illuminate\Database\Seeder;
use App\BlogCategory;

class BlogCategorySeeder extends Seeder {
    public function run() {
        $categories = [
            [
                'name' => 'News'
            ],
            [
                'name' => 'Promo'
            ],
        ];
        foreach ($categories as $value) {
            BlogCategory::create($value);
        }
    }
}
