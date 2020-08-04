<?php

use App\SignupTitle;
use Illuminate\Database\Seeder;

class SignupTitleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SignupTitle::truncate();

        /*$signupTitle = SignupTitle::create([
           'title' => 'Who is coming to the party tonight?'
        ]);*/
    }
}
