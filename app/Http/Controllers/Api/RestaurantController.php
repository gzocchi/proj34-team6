<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        // $restaurants = Restaurant::paginate(6);

        return response()->json($restaurants);
    }

    public function show($slug)
    {

        // $restaurant = Restaurant::where('slug', $slug)->first();
        $restaurant = Restaurant::where('slug', $slug)->with(['dishes'])->first();

        return response()->json($restaurant);
    }

    public function shipping($restaurant_id)
    {

        $restaurant = Restaurant::where('id', $restaurant_id)->first();
        $shipping = [
            'shipping' => $restaurant->shipping,
            'shipping_free' => $restaurant->shipping_free
        ];

        return response()->json($shipping);
    }
}
