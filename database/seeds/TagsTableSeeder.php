<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::truncate();

        $vconnect = Tag::create([
            'name' => 'vconnect'
        ]);

        $shippii = Tag::create([
            'name' => 'shippii'
        ]);

        $news = Tag::create([
            'name' => 'news'
        ]);

        $massage = Tag::create([
            'name' => 'massage'
        ]);

        $poll = Tag::create([
            'name' => 'poll'
        ]);

        $events = Tag::create([
            'name' => 'events'
        ]);

        $brandHouse = Tag::create([
            'name' => 'BrandHouse'
        ]);
    }
}
