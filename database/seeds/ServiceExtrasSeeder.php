<?php

use Illuminate\Database\Seeder;
use App\ServiceExtras;
use App\ServiceExtrasTemplate;

class ServiceExtrasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $template = ServiceExtrasTemplate::first();
        $extras = new ServiceExtras;
        $extras->name = $template->name;
        $extras->description = $template->description;
        $extras->price = $template->price;
        $extras->price_token = $template->price_token;
        $extras->is_template = true;
        $extras->template_id = $template->id;
        $extras->save();       
        factory(ServiceExtras::class, 50)->create()->each(function ($extras) {
            $extras->make();
        });
    }
}
