<?php

use App\Order;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dishes = config('dishes');
        $restaurantSlug = 'how-i-met-your-burger';
        $restaurantDishes = [];

        foreach ($dishes as $dish) {
            if (Arr::get($dish, 'restaurant_slug') == $restaurantSlug) {
                array_push($restaurantDishes, $dish);
            }
        }

        // $quantity = rand(1, 9);
        dd($restaurantDishes);
    }
}
