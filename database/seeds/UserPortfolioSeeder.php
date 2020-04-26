<?php

use Illuminate\Database\Seeder;
use App\UserPortfolio;

class UserPortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $portfolios = [
            [
                'title'=>'user 2 portfolio 1',
                'image_url'=>'/img/cover.jpg',
                'user_id'=>2
            ],
            [
                'title'=>'user 2 portfolio 2',
                'image_url'=>'/img/cover.jpg',
                'user_id'=>2
            ],
            [
                'title'=>'user 2 portfolio 3',
                'image_url'=>'/img/cover.jpg',
                'user_id'=>2
            ],
            [
                'title'=>'user 3 portfolio 1',
                'image_url'=>'/img/cover.jpg',
                'user_id'=>3
            ],
            [
                'title'=>'user 4 portfolio 1',
                'image_url'=>'/img/cover.jpg',
                'user_id'=>4
            ],
            [
                'title'=>'user 4 portfolio 2',
                'image_url'=>'/img/cover.jpg',
                'user_id'=>4
            ],
        ];
        foreach ($portfolios as $key => $value) {
            UserPortfolio::create($value);
        }
    }
}
