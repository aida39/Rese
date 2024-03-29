<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => '1',
            'shop_id' => '1',
            'course_id' => '1',
            'reservation_date' => '2024-01-01',
            'reservation_time' => '18:30:00',
            'member_count' => '3',
            'visited_flag' => '1',
        ];
        DB::table('reservations')->insert($param);
        $param = [
            'user_id' => '1',
            'shop_id' => '2',
            'course_id' => '2',
            'reservation_date' => '2024-02-01',
            'reservation_time' => '18:00:00',
            'member_count' => '4',
            'visited_flag' => '1',
        ];
        DB::table('reservations')->insert($param);
        $param = [
            'user_id' => '1',
            'shop_id' => '3',
            'course_id' => '3',
            'reservation_date' => '2024-06-01',
            'reservation_time' => '19:00:00',
            'member_count' => '2',
            'visited_flag' => '0',
        ];
        DB::table('reservations')->insert($param);
        $param = [
            'user_id' => '2',
            'shop_id' => '1',
            'course_id' => '2',
            'reservation_date' => '2024-01-01',
            'reservation_time' => '18:30:00',
            'member_count' => '3',
            'visited_flag' => '1',
        ];
        DB::table('reservations')->insert($param);
        $param = [
            'user_id' => '2',
            'shop_id' => '2',
            'course_id' => '2',
            'reservation_date' => '2024-02-01',
            'reservation_time' => '18:00:00',
            'member_count' => '4',
            'visited_flag' => '1',
        ];
        DB::table('reservations')->insert($param);
        $param = [
            'user_id' => '2',
            'shop_id' => '3',
            'course_id' => '1',
            'reservation_date' => '2024-06-01',
            'reservation_time' => '19:00:00',
            'member_count' => '2',
            'visited_flag' => '0',
        ];
        DB::table('reservations')->insert($param);
        $param = [
            'user_id' => '3',
            'shop_id' => '1',
            'course_id' => '2',
            'reservation_date' => '2024-08-01',
            'reservation_time' => '18:30:00',
            'member_count' => '3',
            'visited_flag' => '0',
        ];
        DB::table('reservations')->insert($param);
        $param = [
            'user_id' => '3',
            'shop_id' => '2',
            'course_id' => '3',
            'reservation_date' => '2024-09-01',
            'reservation_time' => '18:00:00',
            'member_count' => '4',
            'visited_flag' => '0',
        ];
        DB::table('reservations')->insert($param);
        $param = [
            'user_id' => '3',
            'shop_id' => '3',
            'course_id' => '1',
            'reservation_date' => '2024-06-01',
            'reservation_time' => '19:00:00',
            'member_count' => '2',
            'visited_flag' => '0',
        ];
        DB::table('reservations')->insert($param);
        $param = [
            'user_id' => '3',
            'shop_id' => '4',
            'course_id' => '3',
            'reservation_date' => '2024-07-01',
            'reservation_time' => '18:00:00',
            'member_count' => '4',
            'visited_flag' => '0',
        ];
        DB::table('reservations')->insert($param);
    }
}
