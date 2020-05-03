<?php

use Illuminate\Database\Seeder;
use App\Faq;

class FaqSeeder extends Seeder {
    public function run() {
        factory(Faq::class, 30)->create()->each(function ($faq) {
            $faq->make();
        });
    }
}
