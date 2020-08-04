<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        $event = Category::create([
           'name' => 'Events'
        ]);
        $massage = Category::create([
            'name' => 'Food'
        ]);
        $dinner = Category::create([
            'name' => 'Others'
        ]);
    }
}
