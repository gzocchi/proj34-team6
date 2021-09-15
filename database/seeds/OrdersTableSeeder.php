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

        $randomDish = rand(0, (count($restaurantDishes) - 1));
        $randomQuantity = rand(1, 9);


        $order = [];
        for ($i = 0; $i < $randomQuantity; $i++) {
            # code...
        }



        $date = date('Y-m-d H:i:s', strtotime('-' . (3) . ' days'));


        $amount = 0;

        $dataOrder = [
            "price" => $amount,
            "paid" =>  true,
            'restaurant_id' => 'id',
            "customer_name" => 'customer_name',
            "customer_mail" => 'customer_mail',
            "customer_address" => 'customer_address',
            "customer_telephone" => 'customer_telephone',
        ];
        $newOrder = new Order();
        $newOrder->fill($dataOrder);
        $newOrder->created_at = $date;
        $newOrder->save();


        // dd($date);
        dd($date);
    }
}
