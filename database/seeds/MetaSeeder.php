<?php

use Illuminate\Database\Seeder;

class MetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('meta_seo')->insert([
        [
          'name' => 'keyword',
          'value' => 'desain grafis'
        ],
        [
          'name' => 'keyword',
          'value' => 'jasa desain grafis'
        ],
        [
          'name' => 'keyword',
          'value' => 'jasa design graphic'
        ],
        [
          'name' => 'keyword',
          'value' => 'jasa logo'
        ],
        [
          'name' => 'keyword',
          'value' => 'desain logo'
        ],
        [
          'name' => 'keyword',
          'value' => 'design logo'
        ],
        [
          'name' => 'keyword',
          'value' => 'desain'
        ],
        [
          'name' => 'keyword',
          'value' => 'desain kemasan'
        ],
        [
          'name' => 'keyword',
          'value' => 'desain instagram'
        ],
        [
          'name' => 'keyword',
          'value' => 'jasa desain'
        ],
      ]);
    }
}
