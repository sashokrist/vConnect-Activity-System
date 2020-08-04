<?php

use App\PollResult;
use Illuminate\Database\Seeder;

class PollResultTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PollResult::truncate();
    }
}
