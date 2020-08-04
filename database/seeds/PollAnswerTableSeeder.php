<?php

use App\PollAnswer;
use Illuminate\Database\Seeder;

class PollAnswerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PollAnswer::truncate();

        /*$jamaica = PollAnswer::create([
           'name' => 'Jamaica',
           'poll_id' => '1'
        ]);

        $spain = PollAnswer::create([
            'name' => 'Spain',
            'poll_id' => '1'
        ]);

        $greece = PollAnswer::create([
            'name' => 'Greece',
            'poll_id' => '1'
        ]);

        $sozopol = PollAnswer::create([
            'name' => 'Sozopol',
            'poll_id' => '1'
        ]);*/
    }
}
