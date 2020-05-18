<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Subscription;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sub = Subscription::first();
        $user = [
            [
                'name'=>'Admin',
                'email'=>'admin@test.com',
                'role'=>'admin',
                'password'=> Hash::make('password'),
            ],
            [
                'name'=>'Agent',
                'email'=>'agent@test.com',
                'role'=>'agent',
                'email_verified_at' => now(),
                'password'=> Hash::make('password'),
            ],
            [
                'name'=>'Agent2',
                'email'=>'agent2@test.com',
                'role'=>'agent',
                'password'=> Hash::make('password'),
            ],
            [
                'name'=>'User',
                'email_verified_at' => Carbon::now(),
                'email'=>'user@test.com',
                'password'=> Hash::make('password'),
            ],
            [
                'name'=>'User Subscript',
                'email'=>'usersub@test.com',
                'is_subscribe'=>'1',
                'subscribe_to'=>$sub->id,
                'subscribe_token'=>$sub->token,
                'subscribe_at'=> Carbon::now(),
                'password'=> Hash::make('password'),
            ],
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
