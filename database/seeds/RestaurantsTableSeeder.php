<?php

use Illuminate\Database\Seeder;
use App\Restaurant;
use App\Type;
use Illuminate\Support\Str;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 3; $i++) {
            $restaurant = new Restaurant();

            $restaurant->user_id = 1;
            $restaurant->name = "Ristorante " . $i;
            $restaurant->address = "Via " . $i;
            $restaurant->p_iva = "1234567891" . $i;
            $restaurant->shipping = 3;
            $restaurant->slug = Str::slug($restaurant->name, '-');
            
            $restaurant->save();

        }

        // Get all the roles attaching up to 3 random roles to each user
        $types = App\Type::all();

        // Populate the pivot table
        App\Restaurant::all()->each(function ($restaurant) use ($types) { 
            $restaurant->types()->attach(
                $types->random(rand(1, 3))->pluck('id')->toArray()
            ); 
        });
    }
}
