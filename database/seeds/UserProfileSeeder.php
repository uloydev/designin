<?php

use Illuminate\Database\Seeder;
use App\UserProfile;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = [
            [
                'handphone'=>'08123456789',
                'alamat'=>'jonggol',
                'bank'=>'bni',
                'account_number'=>'12345667899',
                'user_id'=>1
            ],
            [
                'handphone'=>'08123456789',
                'alamat'=>'jonggol',
                'bank'=>'bni',
                'account_number'=>'12345667899',
                'user_id'=>2
            ],
            [
                'handphone'=>'08123456789',
                'alamat'=>'jonggol',
                'bank'=>'bni',
                'account_number'=>'12345667899',
                'user_id'=>3
            ],
            [
                'handphone'=>'08123456789',
                'alamat'=>'jonggol',
                'bank'=>'bni',
                'account_number'=>'12345667899',
                'user_id'=>4
            ],
        ];
        foreach ($profiles as $key => $value) {
            UserProfile::create($value);
        }
    }
}
