<?php

use App\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Post::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');*/
        Post::query()->delete();

        factory(Post::class, 1)->create();
    }
}
