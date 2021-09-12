<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = [
        'restaurant_id',
        'category_id',
        'name',
        'description',
        'img',
        'price',
        'visible'
    ];
    
    // relazione piatto - categoria
    public function category() {
        return $this->belongsTo('App\Category');
    }

    // relazione piatto - ristorante
    public function restaurant() {
        return $this->belongsTo('App\Restaurant');
    }

    // relazione piatto - ordine
    public function orders() {
        return $this->belongsToMany('App\Order', 'order_dish', 'dish_id', 'order_id');
    }
}
