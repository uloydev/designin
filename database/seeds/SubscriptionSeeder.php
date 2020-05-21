<?php

use App\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Subscription::class, 4)->create()->each(function ($subscription) {
            $subscription->make();
        });
    }
}
