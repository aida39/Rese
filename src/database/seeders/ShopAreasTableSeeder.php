<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopAreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shop_areas')->insert([
            'shop_area' => '東京都',
        ]);
        DB::table('shop_areas')->insert([
            'shop_area' => '大阪府',
        ]);
        DB::table('shop_areas')->insert([
            'shop_area' => '福岡県',
        ]);
    }
}
