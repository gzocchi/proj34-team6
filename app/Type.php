<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    // relazione ristorante - tipo
    public function restaurants() {
        return $this->belongsToMany('App\Restaurant', 'restaurant_type', 'type_id', 'restaurant_id');
    }
}
