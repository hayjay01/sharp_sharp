<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t1 = 'Laravel';
        $t2 = 'PHP 7.0';
        $t3 = 'CSS 3';
        $t4 = 'HTML 5';
        $t5 = 'JQUERY';
        $t6 = 'AJAX';
        $t7 = 'JAVASCRIPT';
        $t8 = 'Angular JS';

        $channel1 = ['title' => $t1, 'slug' => str_slug($t1)];
        $channel2 = ['title' => $t2, 'slug' => str_slug($t2)];
        $channel3 = ['title' => $t3, 'slug' => str_slug($t3)];
        $channel4 = ['title' => $t4, 'slug' => str_slug($t4)];
        $channel5 = ['title' => $t5, 'slug' => str_slug($t5)];
        $channel6 = ['title' => $t6, 'slug' => str_slug($t6)];
        $channel7 = ['title' => $t7, 'slug' => str_slug($t7)];
        $channel8 = ['title' => $t8, 'slug' => str_slug($t8)];

        Category::create($channel1);
        Category::create($channel2);
        Category::create($channel3);
        Category::create($channel4);
        Category::create($channel5);
        Category::create($channel6);
        Category::create($channel7);
        Category::create($channel8);
    }
}
