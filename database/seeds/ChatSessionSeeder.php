<?php

use Illuminate\Database\Seeder;
use App\ChatSession;
use App\User;

class ChatSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('role','user')->pluck('id')->all();
        $agents = User::where('role','agent')->pluck('id')->all();
        foreach ($users as $user) {
            foreach ($agents as $agent) {
                ChatSession::create([
                    'user_id'=>$user,
                    'agent_id'=>$agent
                ]);
            }
        }

    }
}
