<?php

use Illuminate\Database\Seeder;
use App\ContactUs;
use App\User;

class ContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_id = User::where('role', 'admin')->first()->id;
        $messages = [
            [
                'name'=>'guest1',
                'email'=>'guest1@test.com',
                'message'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, rerum velit aliquam aut similique totam nihil quasi iusto beatae in?'
            ],
            [
                'name'=>'guest2',
                'email'=>'guest2@test.com',
                'message'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, rerum velit aliquam aut similique totam nihil quasi iusto beatae in?',
                'answer'=>'Lorem ipsum dolor sit',
                'is_answered'=>1,
                'admin_id'=>$admin_id
            ],
            [
                'name'=>'guest3',
                'email'=>'guest3@test.com',
                'message'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, rerum velit aliquam aut similique totam nihil quasi iusto beatae in?'
            ],
            [
                'name'=>'guest4',
                'email'=>'guest4@test.com',
                'message'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, rerum velit aliquam aut similique totam nihil quasi iusto beatae in?',
                'answer'=>'Lorem ipsum dolor sit',
                'is_answered'=>1,
                'admin_id'=>$admin_id
            ],
        ];
        foreach ($messages as $key => $value) {
            ContactUs::create($value);
        }
    }
}
