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
        factory(ServiceCategory::class, 7)->create()->each(function ($serviceCategory) {
            $serviceCategory->make();
        });
    }
}
