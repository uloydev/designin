<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call([
        UserSeeder::class,
        MetaSeeder::class,
        ServiceSeeder::class,
        PackageSeeder::class,
        CarouselImageSeeder::class,
        BlogSeeder::class,
        FaqSeeder::class,
        ContactUsSeeder::class,
        ServiceCategorySeeder::class,
        UserProfileSeeder::class,
        UserPortfolioSeeder::class
      ]);
    }
}
