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
          SubscriptionSeeder::class,
          UserSeeder::class,
          MetaSeeder::class,
          ServiceSeeder::class,
          PackageSeeder::class,
          CarouselImageSeeder::class,
          ClientSeeder::class,
          FaqSeeder::class,
          FaqCategorySeeder::class,
          ContactUsSeeder::class,
          ServiceCategorySeeder::class,
          UserProfileSeeder::class,
          UserPortfolioSeeder::class,
          BlogSeeder::class,
          BlogCategorySeeder::class,
          TestimonySeeder::class,
          OrderSeeder::class,
          ChatSessionSeeder::class,
          ReasonSeeder::class,
          PromoSeeder::class,
          ServiceExtrasTemplateSeeder::class,
          ServiceExtrasSeeder::class,
          TokenConversionSeeder::class,
          SubscribeDataSeeder::class
      ]);
    }
}
