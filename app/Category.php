<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
    ];

    // relazione piatto - categoria
    public function dishes() {
        return $this->HasMany('App\Dish');
    }
    
}
