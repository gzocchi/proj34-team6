<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'price',
        'paid',
        'customer_name',
        'customer_address',
        'customer_telephone',
        'customer_mail'
    ];

    // relazione piatto - ordine
    public function dishes()
    {
        return $this->belongsToMany('App\Dish', 'order_dish', 'order_id', 'dish_id');
    }

    // relazione ordine - utente
    // public function customers()
    // {
    //     return $this->hasOne('App\Customer');
    // }
}
