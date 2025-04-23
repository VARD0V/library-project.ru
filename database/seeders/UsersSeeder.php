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
            ['id' => 1, 'birthday' => '1990-05-15', 'email' => 'admin@example.com', 'login' => 'admin', 'password' => Hash::make('admin123'), 'avatar_url' => 'avatars/admin.jpg', 'api_token' => 'token_admin_123', 'role_id' => 1],
            ['id' => 2, 'birthday' => '1985-08-20', 'email' => 'user1@example.com', 'login' => 'user1', 'password' => Hash::make('user1_pass'), 'avatar_url' => null, 'api_token' => 'token_user1_456', 'role_id' => 2],
            ['id' => 3, 'birthday' => '1992-12-25', 'email' => 'user2@example.com', 'login' => 'user2', 'password' => Hash::make('user2_pass'), 'avatar_url' => 'avatars/user2.jpg', 'api_token' => 'token_user2_789', 'role_id' => 2],
            ['id' => 4, 'birthday' => '1988-07-10', 'email' => 'user3@example.com', 'login' => 'user3', 'password' => Hash::make('user3_pass'), 'avatar_url' => null, 'api_token' => 'token_user3_101', 'role_id' => 2],
        ]);
    }
}
