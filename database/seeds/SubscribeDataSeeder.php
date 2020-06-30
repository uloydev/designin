<?php

use Illuminate\Database\Seeder;
use App\SubscribeData;
use App\User;
use App\Subscription;
use Illuminate\Support\Carbon;

class SubscribeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 5; $i++) {
            $subscription = Subscription::inRandomOrder()->first();
            $data = [
                'user_id' => User::where('role', 'user')->inRandomOrder()->first()->id,
                'subscription_id' => $subscription->id,
                'subscribe_at' => Carbon::now(),
                'expired_at' => Carbon::now()->addDays($subscription->duration),
                'price' => $subscription->price,
                'token' => $subscription->token,
                'duration' => $subscription->duration
            ];
            SubscribeData::create($data);
        }
    }
}
