<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'course' => '松',
            'price' => '10000',
        ];
        DB::table('courses')->insert($param);

        $param = [
            'course' => '竹',
            'price' => '5000',
        ];
        DB::table('courses')->insert($param);

        $param = [
            'course' => '梅',
            'price' => '3000',
        ];
        DB::table('courses')->insert($param);
    }
}
