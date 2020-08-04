<?php

use App\MassageUser;
use Illuminate\Database\Seeder;

class MassageUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MassageUser::truncate();
    }
}
