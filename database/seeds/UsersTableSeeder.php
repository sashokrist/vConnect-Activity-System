<?php

use App\Group;
use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();
        $userGroup = Group::where('title', 'Common')->first();

        $admin = User::create([
           'name' => 'Admin User',
           'email' => 'admin@admin.com',
           'password' => \Illuminate\Support\Facades\Hash::make('admin'),
            'email_verified_at' => '2019-07-02 00:00:00',
        ]);

        $user = User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => \Illuminate\Support\Facades\Hash::make('user'),
            'email_verified_at' => '2019-07-02 00:00:00',
        ]);
        //attach to admin user which has been created the adminRole using relation roles()
        $admin->roles()->attach($adminRole);
        //$admin->roles()->attach($userRole);
        $user->roles()->attach($userRole);
        $admin->groups()->attach($userGroup);
        $user->groups()->attach($userGroup);

    }
}
