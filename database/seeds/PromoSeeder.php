<?php

use Illuminate\Database\Seeder;
use App\Promo;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Promo::class, 10)->create()->each(function ($promo) {
            $promo->make();
        });
    }
}
