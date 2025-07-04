<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            [
                'user_id' => 2, // 旅館ユーザー
                'title' => '温泉旅館「さくら」',
                'content' => '天然温泉と季節の料理が自慢の宿。',
                'address' => '東京都千代田区1-1-1',
                'image_path' => null,
                'price' => '15000',
                'max_guest' => 4,
                'available_from' => '2025-07-01',
                'available_to' => '2025-12-31',
            ],
        ]);
    }
}
