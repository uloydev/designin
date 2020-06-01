<?php

use Illuminate\Database\Seeder;
use App\Service;
use Faker\Factory as Faker;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Service::class, 30)->create()->each(function ($service) {
            $service->make();
        });
    }
}
