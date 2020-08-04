<?php

use App\Group;
use App\Groups;
use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::truncate();

        $common = Group::create([
            'title' => 'Common'
        ]);

        $vConnect = Group::create([
           'title' => 'vConnect'
        ]);

        $vConnectFrontend = Group::create([
            'title' => 'vConnect-frontend'
        ]);

        $shippii = Group::create([
            'title' => 'Shippii'
        ]);

        $shippiiFronend = Group::create([
            'title' => 'Shippii-frontend'
        ]);

        $brandHouse = Group::create([
            'title' => 'BrandHouse'
        ]);

    }
}
