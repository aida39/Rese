<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopGenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shop_genres')->insert([
            'shop_genre' => '寿司',
        ]);
        DB::table('shop_genres')->insert([
            'shop_genre' => '焼肉',
        ]);
        DB::table('shop_genres')->insert([
            'shop_genre' => '居酒屋',
        ]);
        DB::table('shop_genres')->insert([
            'shop_genre' => 'イタリアン',
        ]);
        DB::table('shop_genres')->insert([
            'shop_genre' => 'ラーメン',
        ]);
    }
}
