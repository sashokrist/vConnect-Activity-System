<?php

use App\Signup;
use Illuminate\Database\Seeder;

class SignupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Signup::truncate();

    }
}
