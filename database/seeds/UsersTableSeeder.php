<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name'  => 'admin',
            'email' => 'admin@udemy-forum.dev',
            'password'  => bcrypt('admin'),
            'admin' => 1,
            'avatar'    => '/uploads/avatars/avatar.png'
        ]);
    }
}
