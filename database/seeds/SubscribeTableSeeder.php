<?php

use App\Subscribe;
use Illuminate\Database\Seeder;

class SubscribeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscribe::truncate();

        $subscribePoll = Subscribe::create([
           'title' => 'Poll'
        ]);

        $subscribePNews = Subscribe::create([
            'title' => 'News'
        ]);

        $subscribeSignup = Subscribe::create([
            'title' => 'Signup'
        ]);

        $subscribeMassage = Subscribe::create([
            'title' => 'Massage'
        ]);
    }
}
