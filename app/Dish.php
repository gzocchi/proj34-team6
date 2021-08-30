<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = [
        'restaurant_id',
        'category_id',
        'name',
        'ingredients',
        'description',
        'img',
        'price',
        'visible'
    ];
    
    // relazione piatto - categoria
    public function categories() {
        return $this->belongsTo('App\Category');
    }
}
