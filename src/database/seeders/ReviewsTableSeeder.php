<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'reservation_id' => '1',
            'rating' => '5',
            'comment' => '食材・味・価格、お客様の満足度を徹底的に追及したお店です。美味しかったです！',
            'image_path' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg',
        ];
        DB::table('reviews')->insert($param);
        $param = [
            'reservation_id' => '4',
            'rating' => '4',
            'comment' => '料理長厳選の食材から作る寿司を用いたコースが絶品でした！',
            'image_path' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg',
        ];
        DB::table('reviews')->insert($param);
    }
}
