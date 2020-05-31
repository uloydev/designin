<?php

use App\TokenConversion;
use Illuminate\Database\Seeder;

class TokenConversionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conversion = TokenConversion::create([
            'numeral' => 10000
        ]);
        $conversion->save();
    }
}
