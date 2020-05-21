<?php

use Illuminate\Database\Seeder;
use App\Reason;

class ReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Reason::class, 6)->create()->each(function ($reason) {
            $reason->make();
        });
    }
}
