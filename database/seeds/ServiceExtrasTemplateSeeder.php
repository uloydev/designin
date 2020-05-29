<?php

use Illuminate\Database\Seeder;
use App\ServiceExtrasTemplate;

class ServiceExtrasTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $template = new ServiceExtrasTemplate;
        $template->name = "fast delivery";
        $template->description = "reduce deadline by 1 day";
        $template->price = 50000;
        $template->price_token = 5;
        $template->effect = "deadline-1";
        $template->save();
    }
}
