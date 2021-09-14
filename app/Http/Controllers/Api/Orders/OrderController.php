<?php

namespace App\Http\Controllers\Api\Orders;

use App\Dish;
use App\User;

use App\Order;
use App\Restaurant;

use Braintree\Gateway;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Orders\OrdersRequest; // utile?

class OrderController extends Controller
{

    public function generate(Request $request, Gateway $gateway)
    {

        $token = $gateway->clientToken()->generate();

        $data = [
            'success' => true,
            // token di andata
            'token' => $token
        ];

        return response()->json($data, 200);
    }

    // Request vs OrderRequest?
    public function makePayment(Request $request, Gateway $gateway)
    {

        $validator = Validator::make(
            $request->all(),
            [
                "token" => "required",
                'customer_name' => "required|string|min:5|max:60",
                'customer_mail' => "required|max:100",
                'customer_address' => "required|min:5",
                'customer_telephone' => "required|min:9|max:10",
                "dishes" => "required", // ?
            ],
            [
                'required' => 'Questo campo è obbligatorio',
                'name.max' => 'Massimo :max caratteri concessi',
                'min' => 'Minimo :min caratteri richiesti',
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        // build data
        $all_dishes = [];
        foreach ($request->dishes as $dish) {
            $newDish = Dish::where('restaurant_id', $dish['restaurant_id'])->where('id', $dish['id'])->first()->toArray();
            $newDish['quantity'] = $dish['quantity'];
            array_push($all_dishes, $newDish);
        }

        $amount = 0;
        foreach ($all_dishes as $dish) {
            $amount += Arr::get($dish, 'price') * Arr::get($dish, 'quantity');
        }
        
        $restaurant = Restaurant::where('id', $all_dishes[0]['restaurant_id'])->first();
        $shipping = $restaurant->shipping;
        $shipping_free = $restaurant->shipping_free;
        if ($amount > $shipping_free) {
            $shipping = 0;
        } else {
            $amount += $shipping;
        }

        $dataOrder = [
            "price" => $amount,
            "paid" =>  true,
            'restaurant_id' => $restaurant->id,
            "customer_name" => $request->customer_name,
            "customer_mail" => $request->customer_mail,
            "customer_address" => $request->customer_address,
            "customer_telephone" => $request->customer_telephone,
        ];

        // token di ritorno
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
        // ritorno SUCCESSFULL
        if ($result->success) {
            $data = [
                'success' => true,
                'message' => "Transazione eseguita"
            ];

            // save order
            $newOrder = new Order();
            $newOrder->fill($dataOrder);
            $newOrder->save();

            foreach ($all_dishes as $dish) {
                $newOrder->dishes()->attach(Arr::get($dish, 'id'), ['quantity' => Arr::get($dish, 'quantity')]);
            }

            // info USER + RESTAURANTS ?
            // $user= User::where("id", $dish->restaurant_id["user_id"])->get()->first();

            // $newOrder =  [
            //     "total" => $amount,
            //     // ?
            //     "restaurant_name" => $dish->restaurant_id->name,
            //     "restaurant_id" => $dish->restaurant_id->id,

            //     "customer_name" => $request->customer_name,
            //     "customer_address" => $request->customer_address,

            //     "all_dishes" => $all_dishes,
            //     "x" => $user['name'],
            // ];

            // Mail::to($request->payer_email)->send(new SendMail($newOrder));
            // Mail::to($user['email'])->send(new SendAdminMail($newOrder));

            return response()->json($data, 200);
        } else {
            $data = [
                'success' => false,
                'message' => "Transazione fallita."
            ];

            return response()->json($data, 401);
        }
        // return 'token ritorno';
    }
}
