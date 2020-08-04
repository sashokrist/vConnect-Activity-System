<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();

        $post = Post::create([
           'title' => 'New Massage Post',
            'body' => 'Massage test test test test test',
            'created_at' => '2019-07-02 00:00:00',
            'category_id' => 1
        ]);
    }
}
