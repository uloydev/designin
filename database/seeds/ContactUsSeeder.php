<?php

use Illuminate\Database\Seeder;
use App\ContactUs;

class ContactUsSeeder extends Seeder
{

    public function run()
    {
        factory(ContactUs::class, 29)->create()->each(function ($message) {
            $message->make();
        });

        $faker = Faker\Factory::create();

        $message = new ContactUs;
        $message->name = 'Bariq Dharmawan';
        $message->email = 'bariq.2nd.rodriguez@gmail.com';
        $message->message = $faker->paragraph($nbSentences = 6, $variableNbSentences = true);
        $message->save();
    }
}
