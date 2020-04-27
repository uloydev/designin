<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('faq_category')->insert([
          [
            'category' => 'news'
          ],
          [
            'category' => 'promo'
          ]
      ]);
    }
}
