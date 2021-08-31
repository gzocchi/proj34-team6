<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Restaurant;
use App\Type;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants = config('restaurants');

        $img_path = base_path().DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'restaurants';
        $dst_path = 'restaurants';

        foreach ($restaurants as $item) {

            $contents = file_get_contents($img_path.DIRECTORY_SEPARATOR.$item['logo']);
            Storage::put($dst_path.DIRECTORY_SEPARATOR.$item['logo'], $contents);

            $contents = file_get_contents($img_path.DIRECTORY_SEPARATOR.$item['bg_image']);
            Storage::put($dst_path.DIRECTORY_SEPARATOR.$item['bg_image'], $contents);


            $restaurant = new Restaurant();
            $restaurant->user_id = 1;
            $restaurant->name = $item['name'];
            $restaurant->address = $item['address'];
            $restaurant->p_iva = $item['p_iva'];
            $restaurant->logo = $dst_path.DIRECTORY_SEPARATOR.$item['logo'];
            $restaurant->bg_image = $dst_path.DIRECTORY_SEPARATOR.$item['bg_image'];
            $restaurant->shipping = $item['shipping'];
            $restaurant->shipping_free = $item['shipping_free'];
            $restaurant->vote = $item['vote'];
            $restaurant->slug = Str::slug($restaurant->name, '-');
            $restaurant->save();

            $type = App\Type::where('name', $item['type'])->first();
            $restaurant->types()->attach($type->id);
        }        
    }
}
