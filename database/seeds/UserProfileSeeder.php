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
        factory(UserProfile::class, 5)->create()->each(function ($profile) {
            $profile->make();
        });
    }
}
