<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LandingHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('landing_header_slider')->insert([
            [
                'img' => 'files/cover.jpg',
                'created_at' => Carbon::now()
            ],
            [
                'img' => 'files/landing-header2.jpg',
                'created_at' => Carbon::now()
            ],
            [
                'img' => 'files/landing-header3.jpg',
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
