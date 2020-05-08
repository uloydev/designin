<?php

use Illuminate\Database\Seeder;
use App\Testimony;

class TestimonySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Testimony::class, 10)->create()->each(function ($testimony) {
            $testimony->make();
        });
    }
}
