<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call(UsersTableSeeder::class);    // seed users

        $this->call(ChannelsTableSeeder::class); // seed channels
    }
}
