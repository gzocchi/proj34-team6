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
        Route::get('restaurant/{slug}', 'RestaurantController@show');

        // recupero i piatti di un ristorante
        // Route::get('dishes/{slug}', 'DishController@dishesRestaurant');
    });