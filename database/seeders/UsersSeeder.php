<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            ['id' => 1, 'birthday' => '1990-05-15', 'email' => 'admin@example.com', 'login' => 'admin', 'password' => Hash::make('admin123'), 'avatar_url' => null, 'role_id' => 1],
            ['id' => 2, 'birthday' => '1985-08-20', 'email' => 'user1@example.com', 'login' => 'user1', 'password' => Hash::make('user1_pass'), 'avatar_url' => null, 'role_id' => 2],
            ['id' => 3, 'birthday' => '1992-12-25', 'email' => 'user2@example.com', 'login' => 'user2', 'password' => Hash::make('user2_pass'), 'avatar_url' => null, 'role_id' => 2],
            ['id' => 4, 'birthday' => '1988-07-10', 'email' => 'user3@example.com', 'login' => 'user3', 'password' => Hash::make('user3_pass'), 'avatar_url' => null, 'role_id' => 2],
        ]);
    }
}
