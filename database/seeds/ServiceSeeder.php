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
        for ($service = 1; $service <= 10; $service++) {
            $faker = Faker::create('id_ID');
            DB::table('service')->insert([
        		'title' => 'Desain ' . $faker->word,
        		'description' => $faker->paragraph,
                'image' => 'files/stories.jpeg',
        		'agent_id' => $faker->unique()->numberBetween(2, 3),
        		'service_category_id' => $faker->unique()->numberBetween(1, 6)
           	]);
        }
    }
}
