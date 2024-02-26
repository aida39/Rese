<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManagersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'manager01',
            'email' => 'manager01@example.com',
            'email_verified_at' => '2024-01-01 00:00:00',
            'password' => Hash::make('coachtech'),
        ];
        DB::table('managers')->insert($param);
        $param = [
            'name' => 'manager02',
            'email' => 'manager02@example.com',
            'email_verified_at' => '2024-01-01 00:00:00',
            'password' => Hash::make('coachtech'),
        ];
        DB::table('managers')->insert($param);
        $param = [
            'name' => 'manager03',
            'email' => 'manager03@example.com',
            'email_verified_at' => '2024-01-01 00:00:00',
            'password' => Hash::make('coachtech'),
        ];
        DB::table('managers')->insert($param);
        $param = [
            'name' => 'manager04',
            'email' => 'manager04@example.com',
            'email_verified_at' => '2024-01-01 00:00:00',
            'password' => Hash::make('coachtech'),
        ];
        DB::table('managers')->insert($param);
        $param = [
            'name' => 'manager05',
            'email' => 'manager05@example.com',
            'email_verified_at' => '2024-01-01 00:00:00',
            'password' => Hash::make('coachtech'),
        ];
        DB::table('managers')->insert($param);
        $param = [
            'name' => 'manager06',
            'email' => 'manager06@example.com',
            'email_verified_at' => '2024-01-01 00:00:00',
            'password' => Hash::make('coachtech'),
        ];
        DB::table('managers')->insert($param);
        $param = [
            'name' => 'manager07',
            'email' => 'manager07@example.com',
            'email_verified_at' => '2024-01-01 00:00:00',
            'password' => Hash::make('coachtech'),
        ];
        DB::table('managers')->insert($param);
        $param = [
            'name' => 'manager08',
            'email' => 'manager08@example.com',
            'email_verified_at' => '2024-01-01 00:00:00',
            'password' => Hash::make('coachtech'),
        ];
        DB::table('managers')->insert($param);
        $param = [
            'name' => 'manager09',
            'email' => 'manager09@example.com',
            'email_verified_at' => '2024-01-01 00:00:00',
            'password' => Hash::make('coachtech'),
        ];
        DB::table('managers')->insert($param);
        $param = [
            'name' => 'manager10',
            'email' => 'manager10@example.com',
            'email_verified_at' => '2024-01-01 00:00:00',
            'password' => Hash::make('coachtech'),
        ];
        DB::table('managers')->insert($param);
    }
}
