<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reservations')->insert([
            [
                'user_id' => 1, // 一般ユーザー
                'post_id' => 1, // 温泉旅館
                'num_guests' => 2,
                'start_date' => '2025-08-10',
                'end_date' => '2025-08-12',
            ],
        ]);
    }
}
