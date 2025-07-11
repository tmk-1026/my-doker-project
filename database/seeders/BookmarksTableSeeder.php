<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookmarksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('bookmarks')->insert([
            [
                'user_id' => 1, // 一般ユーザー
                'post_id' => 1,
            ],
        ]);
    }
}
