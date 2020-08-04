<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(SubscribeTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(GroupUserTableSeeder::class);
        $this->call(MassageUserTableSeeder::class);
        $this->call(SubscribeUserTableSeeder::class);
        $this->call(SignupTableSeeder::class);
        $this->call(SignupTitleTableSeeder::class);
        $this->call(PollResultTableSeeder::class);
        $this->call(PollAnswerTableSeeder::class);
        $this->call(PollTableSeeder::class);
        $this->call(TimeStampTableSeeder::class);
        $this->call(PostCommentsTableSeeder::class);
        $this->call(PollCommentsTableSeeder::class);
        $this->call(ContactUsTableSeeder::class);
    }
}
