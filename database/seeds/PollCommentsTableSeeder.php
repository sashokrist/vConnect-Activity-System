<?php

use App\PollComment;
use Illuminate\Database\Seeder;

class PollCommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PollComment::truncate();
    }
}
