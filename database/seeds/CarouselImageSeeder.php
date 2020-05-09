<?php

use Illuminate\Database\Seeder;
use App\CarouselImage;

class CarouselImageSeeder extends Seeder {
    public function run() {
        $images = [
            [
                'name'=>'dummy image 1',
                'url'=>'https://cdn.pixabay.com/photo/2020/03/26/10/51/norway-4970019_960_720.jpg'
            ],
            [
                'name'=>'dummy image 2',
                'url'=>'https://cdn.pixabay.com/photo/2019/10/04/18/36/milky-way-4526277_960_720.jpg'
            ],
            [
                'name'=>'dummy image 3',
                'url'=>'https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_960_720.jpg'
            ],
            [
                'name'=>'dummy image 4',
                'url'=>'https://cdn.pixabay.com/photo/2013/11/28/10/36/road-220058_960_720.jpg'
            ],
        ];
        foreach ($images as $key => $value) {
            CarouselImage::create($value);
        }
    }
}
