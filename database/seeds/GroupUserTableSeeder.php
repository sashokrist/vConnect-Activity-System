<?php

use App\GroupUser;
use Illuminate\Database\Seeder;

class GroupUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GroupUser::truncate();
    }
}
