<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            [
                'title'=>'Design baju',
                'description'=>'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptate labore reprehenderit repellendus veritatis adipisci aliquam fuga iste consequuntur earum est.',
                'agent_id'=>2,
                'category_id'=>2,
            ],
            [
                'title'=>'Design interior',
                'description'=>'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptate labore reprehenderit repellendus veritatis adipisci aliquam fuga iste consequuntur earum est.',
                'agent_id'=>2,
                'category_id'=>2,
            ],
            [
                'title'=>'Design logo',
                'description'=>'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptate labore reprehenderit repellendus veritatis adipisci aliquam fuga iste consequuntur earum est.',
                'agent_id'=>2,
                'category_id'=>2,
            ],
            [
                'title'=>'Design aplikasi',
                'description'=>'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptate labore reprehenderit repellendus veritatis adipisci aliquam fuga iste consequuntur earum est.',
                'agent_id'=>2,
                'category_id'=>2,
            ],
        ];
        foreach ($services as $key => $value) {
            Service::create($value);
        }
    }
}
