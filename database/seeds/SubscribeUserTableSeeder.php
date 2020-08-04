<?php

use App\SubscribeUser;
use Illuminate\Database\Seeder;

class SubscribeUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubscribeUser::truncate();
    }
}
