<?php

use App\MetaSeo;
use Illuminate\Database\Seeder;

class MetaSeeder extends Seeder {
    public function run() {
        factory(MetaSeo::class, 30)->create()->each(function ($faq) {
            $faq->make();
        });
    }
}
