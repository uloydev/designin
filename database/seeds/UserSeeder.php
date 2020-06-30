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
                'username' => 'admin',
                'role'=>'admin',
                'password'=> Hash::make('password'),
            ],
            [
                'name'=>$faker->name,
                'username' => 'agent_test',
                'email'=>'agent@test.com',
                'role'=>'agent',
                'email_verified_at' => Carbon::now(),
                'password'=> Hash::make('password'),
            ],
            [
                'name'=>$faker->name,
                'username' => $faker->userName,
                'email'=>$faker->freeEmail,
                'role'=>'agent',
                'password'=> Hash::make('password'),
            ],
            [
                'name'=> $faker->name,
                'username' => 'sanchez',
                'email_verified_at' => Carbon::now(),
                'email'=>'sanchez77rodriguez@gmail.com',
                'role' => 'user',
                'password'=> Hash::make('password'),
            ],
            [
                'name'=>$faker->name,
                'username' => 'usersub',
                'email'=>'usersub@test.com',
                'role' => 'user',
                'email_verified_at' => Carbon::now(),
                'password'=> Hash::make('password'),
            ],
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
