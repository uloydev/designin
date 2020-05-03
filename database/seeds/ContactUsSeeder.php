<?php

use Illuminate\Database\Seeder;
use App\ContactUs;

class ContactUsSeeder extends Seeder
{

    public function run()
    {
        factory(ContactUs::class, 30)->create()->each(function ($message) {
            $message->make();
        });
    }
}
