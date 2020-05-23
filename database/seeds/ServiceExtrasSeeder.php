<?php

use Illuminate\Database\Seeder;
use App\ServiceExtras;

class ServiceExtrasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ServiceExtras::class, 50)->create()->each(function ($extras) {
            $extras->make();
        });
    }
}
