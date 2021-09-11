<?php

namespace App\Http\Controllers\Api\Orders;

use App\Dish;
use App\User;

use App\Order;
use App\Restaurant;

use Braintree\Gateway;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Orders\OrdersRequest; // utile?

class OrderController extends Controller
{
        public function generate(Request $request, Gateway $gateway){

            $token = $gateway->clientToken()->generate();
            
            $data = [
                "success" => true,
                "token" => $gateway->clientToken()->generate(),
            ];
    
            return response()->json($data,200);
        }

    // Request vs OrderRequest?
    public function makePayment(Request $request, Gateway $gateway){

        $validator = Validator::make($request->all(),[
            "token" => "required",
            'customer_name' => "required|string|min:5|max:60",
            'customer_mail' => "required|max:100",
            'customer_address' => "required|min:5",
            'customer_telephone' => "required|min:9|max:10",
            "dishes" => "required", // ?
        ],
        [
            'required'=> 'Questo campo è obbligatorio',
            'name.max'=> 'Massimo :max caratteri concessi',
            'min'=> 'Minimo :min caratteri richiesti',
        ]);
        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        dd($request->dishes);

        // buildind data

        // $restaurant = Restaurant::find($request->id);
        $amount = 0; // totale del carello
        $all_dishes = [];
        $dishes = $request->dishes;
        foreach($dishes as $dish) {

            $newDish = Dish::where('restaurant_id', $dish['restaurant_id'])->where('id', $dish['id'])->first();

            $amount += $newDish->price * $dish['quantity'];
            $newDish['quantity'] = $dish['quantity'];

            array_push($all_dishes, $newDish);
        }

        // generate order table
        // $newOrder = new Order();
        // popolate
        // $newOrder->restaurant_id = $request->restaurant_id;
        // $newOrder->customer_name = $request->customer_name;
        // $newOrder->customer_mail = $request->customer_mail;
        // $newOrder->customer_address = $request->customer_address;
        // $newOrder->customer_telephone = $request->customer_telephone;
        // // save
        // $newOrder->price = $amount;
        // $newOrder->save();

        // token di ritorno
        $result = $gateway->transaction()->sale([
            'amount' => $request->amount,
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
        // ritorno SUCCESSFULL
        if($result->success) {
            $data = [
                'success' => true,
                'message' => "Transazione eseguita"
            ];

            // info USER + RESTAURANTS ?
            // $user= User::where("id", $dish['restaurant_id']["user_id"])->get()->first();

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

            return response()->json($data,200);

        } else {
            $data = [
                'success' => false,
                'message' => "Transazione fallita."
            ];

            return response()->json($data,401);
        }
        // return 'token ritorno';
    }
}