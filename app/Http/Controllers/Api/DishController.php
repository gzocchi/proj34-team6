<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
use App\Restaurant;

class DishController extends Controller
{
    public function dishesRestaurant($slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->first();
        $dishes = Dish::where('restaurant_id', $restaurant->id)->get();

        return response()->json($dishes);
    }
}
