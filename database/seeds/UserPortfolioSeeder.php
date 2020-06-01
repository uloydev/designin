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
        factory(UserPortfolio::class, 6)->create()->each(function ($portfolio) {
            $portfolio->make();
        });
    }
}
