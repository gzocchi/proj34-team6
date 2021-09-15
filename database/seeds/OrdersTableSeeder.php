<?php

use App\Dish;
use App\Order;
use App\Restaurant;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // dati per ordine
        $name = ['Giorgio', 'Fabio', 'Stefano', 'Nicolas', 'Elia'];
        $surname = ['Zocchi', 'Marabini', 'Zina', 'Morelli', 'Stellati'];
        $mail = ['google.com', 'libero.it', 'hotmail.com', 'outlook.com', 'tiscali.it', 'boolean.careers'];

        // recupero da dishes.php tutti i piatti di un singolo ristorante in $restaurantDishes
        $dishes = config('dishes');
        $restaurantSlug = 'how-i-met-your-burger';
        $restaurant = Restaurant::where('slug', $restaurantSlug)->first();
        $restaurantDishes = [];

        foreach ($dishes as $dish) {
            if (Arr::get($dish, 'restaurant_slug') == $restaurantSlug) {
                array_push($restaurantDishes, $dish);
            }
        }


        // numero random di piatti da inserire nell'ordine
        $randomOrder = rand(1, count($restaurantDishes));

        // ciclo per recuperare x piatti random da inserire in $orderDishes
        $orderDishes = [];
        for ($i = 0; $i < $randomOrder; $i++) {
            // prendo un piatto random da $restaurantDishes
            $search = true;
            while ($search) {
                $randomDish = rand(0, (count($restaurantDishes) - 1));
                if (!in_array($restaurantDishes[$randomDish], $orderDishes)) {
                    $newDish = $restaurantDishes[$randomDish];

                    $newDish['quantity'] = rand(1, 5);
                    $newDish['restaurant_id'] = $restaurant->id;

                    $realDish = Dish::where('name', $newDish['name'])->where('restaurant_id', $restaurant->id)->first();
                    $newDish['id'] = $realDish->id;

                    array_push($orderDishes, $newDish);
                    $search = false;
                }
            }
        }

        // calcolo prezzo ordine
        $amount = 0;
        $shipping = $restaurant->shipping;
        $shipping_free = $restaurant->shipping_free;

        foreach ($orderDishes as $dish) {
            $amount += Arr::get($dish, 'price') * Arr::get($dish, 'quantity');
        }

        if ($amount > $shipping_free) {
            $shipping = 0;
        } else {
            $amount += $shipping;
        }


        $customer = $name[rand(0, (count($name) - 1))] . ' ' . $surname[rand(0, (count($surname) - 1))];
        $mail = Str::slug($customer, '.') . '@' . $mail[rand(0, (count($name) - 1))];


        $dataOrder = [
            "price" => $amount,
            "paid" =>  true,
            'restaurant_id' => $restaurant->id,
            "customer_name" => $customer,
            "customer_mail" => $mail,
            "customer_address" => 'Piazza Classe, n° 34',
            "customer_telephone" => '3565656565',
        ];

        $newOrder = new Order();
        $newOrder->fill($dataOrder);
        $newOrder->created_at = date('Y-m-d H:i:s', strtotime('-' . mt_rand(1,30) . ' days'));;
        $newOrder->save();

        foreach ($orderDishes as $dish) {
            $newOrder->dishes()->attach(Arr::get($dish, 'id'), ['quantity' => Arr::get($dish, 'quantity')]);
        }
    }
}
