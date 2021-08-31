<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'order_id',
        'name',
        'address',
        'mail',
        'telephone'
    ];

    // relazione ordine - utente
    public function orders() {
        return $this->belongsTo('App\Order');
    }
}
