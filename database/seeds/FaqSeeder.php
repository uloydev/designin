<?php

use Illuminate\Database\Seeder;
use App\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faqs = [
            [
                'question'=>'question 1',
                'answer'=>'answer 1',
                'faq_category_id' => 1,
            ],
            [
                'question'=>'question 2',
                'answer'=>'answer 2',
                'faq_category_id' => 1,
            ],
            [
                'question'=>'question 3',
                'answer'=>'answer 3',
                'faq_category_id' => 2,
            ],
            [
                'question'=>'question 4',
                'answer'=>'answer 4',
                'faq_category_id' => 2
            ],
        ];
        foreach ($faqs as $key => $value) {
            Faq::create($value);
        }
    }
}
