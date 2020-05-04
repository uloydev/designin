<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Testimony;

class TestimonySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_id = User::where('role', 'user')->first()->id; 
        for ($i=1; $i <= 10; $i++) {
            $testimony = [
                'content'=>"i like it, testimony $i",
                'rating'=>($i % 5) + 1,
                'user_id'=>$user_id,
                'service_id'=>($i % 3) + 1
            ];
            $testimony['is_main'] = $i % 2 == 0 ? true : false;
            Testimony::create($testimony);
        }
    }
}
