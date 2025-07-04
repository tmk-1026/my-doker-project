<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        DB::table('users')->truncate();


         DB::table('users')->insert([
            [
                'name' => '一般ユーザー',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'icon' => null,
                'role' => 0,
            ],
            [
                'name' => '旅館ユーザー',
                'email' => 'ryokan@example.com',
                'password' => Hash::make('password'),
                'icon' => null,
                'role' => 1,
            ],
            [
                'name' => '管理者',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'icon' => null,
                'role' => 2,
            ],
        ]);
    }
}
