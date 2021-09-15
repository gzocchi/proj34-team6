<?php

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
            TypesTableSeeder::class,
            CategoriesTableSeeder::class,
            RestaurantsTableSeeder::class,
            DishesTableSeeder::class,
            OrdersTableSeeder::class
        ]);
    }
}
