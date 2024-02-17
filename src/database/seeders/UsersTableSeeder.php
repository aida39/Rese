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
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'user01',
            'email' => 'user01@example.com',
            'email_verified_at' => '2024-01-01 00:00:00',
            'password' => Hash::make('coachtech'),
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'user02',
            'email' => 'user02@example.com',
            'email_verified_at' => '2024-01-01 00:00:00',
            'password' => Hash::make('coachtech'),
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'user03',
            'email' => 'user03@example.com',
            'email_verified_at' => '2024-01-01 00:00:00',
            'password' => Hash::make('coachtech'),
        ];
        DB::table('users')->insert($param);
    }
}
