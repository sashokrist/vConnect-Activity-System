<?php

use App\Massage;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TimeStampTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Massage::truncate();

       /*$massage = Massage::create([
          'start' => '09:00',
           'end' => '15:30',
           'duration' => 15,
           'price' => '5',
           'created_at' => '2020-05-22 09:00:00',
           'massage_date' => '2020-05-22 09:00:00'
       ]);*/

    }
}
