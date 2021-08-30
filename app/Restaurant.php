<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'p_iva',
        'logo',
        'bg_image',
        'shipping',
        'shipping_free',
        'vote',
        'slug'
    ];
    // relazione ristorante - user
    public function users() {
        return $this->belongsTo('App\User');
    }
}
