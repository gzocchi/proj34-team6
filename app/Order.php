<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'price',
        'paid',
        'date'
    ];

    // relazione piatto - ordine
    public function dishes() {
        return $this->belongsToMany('App\Dish');
    }
}
