<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Subscription;

class UserSeeder extends Seeder
{

    public function run()
    {
        $sub = Subscription::first();
        $faker = Faker\Factory::create();
        $user = [
            [
                'name'=>'Admin Desainin',
                'email'=>'admin@test.com',
                'role'=>'admin',
                'password'=> Hash::make('password'),
            ],
            [
                'name'=>$faker->name,
                'email'=>'agent@test.com',
                'role'=>'agent',
                'email_verified_at' => Carbon::now(),
                'password'=> Hash::make('password'),
            ],
            [
                'name'=>$faker->name,
                'email'=>$faker->freeEmail,
                'role'=>'agent',
                'password'=> Hash::make('password'),
            ],
            [
                'name'=>$faker->name,
                'email_verified_at' => Carbon::now(),
                'email'=>'sanchez77rodriguez@gmail.com',
                'role' => 'user',
                'is_subscribe'=> $faker->boolean($chanceOfGettingTrue = 50),
                'password'=> Hash::make('password'),
            ],
            [
                'name'=>$faker->name,
                'email'=>'usersub@test.com',
                'role' => 'user',
                'is_subscribe' => $faker->boolean($chanceOfGettingTrue = 50),
                'subscribe_to'=>$sub->id,
                'subscribe_token'=>$sub->token,
                'subscribe_at'=> Carbon::now(),
                'subscribe_duration'=> $sub->duration,
                'email_verified_at' => Carbon::now(),
                'password'=> Hash::make('password'),
            ],
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
