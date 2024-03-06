<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            AdminsTableSeeder::class,
            ManagersTableSeeder::class,
            ShopAreasTableSeeder::class,
            ShopGenresTableSeeder::class,
            ShopsTableSeeder::class,
            FavoritesTableSeeder::class,
            CoursesTableSeeder::class,
            ReservationsTableSeeder::class,
            ReviewsTableSeeder::class,
        ]);
    }
}
