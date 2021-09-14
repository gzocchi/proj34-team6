<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')
    ->group(function () {

        // tipologie ristoranti
        Route::get('types', 'TypeController@index');
        Route::get('type/{slug}', 'TypeController@show');

        // recupero i ristoranti - tipologia
        Route::get('restaurants', 'RestaurantController@index');

        // recupero ristoranti
        Route::get('restaurant/{slug}', 'RestaurantController@show');
        Route::get('{restaurant_id}/shipping', 'RestaurantController@shipping');

        // recupero i piatti di un ristorante
        Route::get('dishes/{slug}', 'DishController@dishesRestaurant');

        // prova per dish_id
        Route::get('restaurants/{restaurant_id}/dishes/{id}', "DishController@show");

        // token generate
        Route::get('orders/generate',"Orders\OrderController@generate");

        // pagamento
        Route::post('orders/make/payment',"Orders\OrderController@makePayment");
    });