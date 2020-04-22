<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name'=>'Admin',
                'email'=>'admin@test.com',
                'role'=>'admin',
                'password'=> bcrypt('123456'),
            ],
            [
                'name'=>'Agent',
                'email'=>'agent@test.com',
                'role'=>'agent',
                'password'=> bcrypt('123456'),
            ],
            [
                'name'=>'Agent2',
                'email'=>'agent2@test.com',
                'role'=>'agent',
                'password'=> bcrypt('123456'),
            ],
            [
                'name'=>'User',
                'email'=>'user@test.com',
                'password'=> bcrypt('123456'),
            ],
            [
                'name'=>'User Subscript',
                'email'=>'usersub@test.com',
                'is_subscribe'=>'1',
                'password'=> bcrypt('123456'),
            ],
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
