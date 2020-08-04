<?php

use App\Poll;
use Illuminate\Database\Seeder;

class PollTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Poll::truncate();

        /*$poll = Poll::create([
            'name' => 'Where do you want to go for a team building?',
            'created_at' => '2019-07-02 00:00:00'
        ]);*/
    }
}
