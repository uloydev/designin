<?php

use Illuminate\Database\Seeder;
use App\Package;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packages = [
            [
                'title'=>'Design baju basic',
                'description'=>'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptate labore reprehenderit repellendus veritatis adipisci aliquam fuga iste consequuntur earum est.',
                'price'=>200000,
                'service_id'=>1,
                'duration'=>5
            ],
            [
                'title'=>'Design baju pro',
                'description'=>'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptate labore reprehenderit repellendus veritatis adipisci aliquam fuga iste consequuntur earum est.',
                'price'=>500000,
                'service_id'=>1,
                'duration'=>5
            ],
            [
                'title'=>'Design interior pro',
                'description'=>'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptate labore reprehenderit repellendus veritatis adipisci aliquam fuga iste consequuntur earum est.',
                'price'=>2500000,
                'service_id'=>2,
                'duration'=>5
            ],
            [
                'title'=>'Design logo basic',
                'description'=>'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptate labore reprehenderit repellendus veritatis adipisci aliquam fuga iste consequuntur earum est.',
                'price'=>200000,
                'service_id'=>3,
                'duration'=>5
            ],
            [
                'title'=>'Design logo pro',
                'description'=>'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptate labore reprehenderit repellendus veritatis adipisci aliquam fuga iste consequuntur earum est.',
                'price'=>500000,
                'service_id'=>3,
                'duration'=>5
            ],
            [
                'title'=>'Design aplikasi pro',
                'description'=>'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptate labore reprehenderit repellendus veritatis adipisci aliquam fuga iste consequuntur earum est.',
                'price'=>1000000,
                'service_id'=>4,
                'duration'=>5
            ],
        ];
        foreach ($packages as $key => $value) {
            Package::create($value);
        }
    }
}
