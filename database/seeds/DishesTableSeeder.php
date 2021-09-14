<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use App\Dish;

class DishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dishes = config('dishes');
        $img_path = base_path() . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'dishes';
        $dst_path = 'dishes';

        foreach ($dishes as $item) {

            $dish = new Dish();

            $restaurant = App\Restaurant::where('slug', Arr::get($item, 'restaurant_slug'))->first();
            $dish->restaurant_id = $restaurant->id;

            $category = App\Category::where('name', Arr::get($item, 'category_name'))->first();
            $dish->category_id = $category['id'];

            $dish->name = $item['name'];
            $dish->description = $item['description'];

            if (Arr::has($item, 'img')) {
                $contents = file_get_contents($img_path . DIRECTORY_SEPARATOR . Arr::get($item, 'img'));
                Storage::put($dst_path . DIRECTORY_SEPARATOR . Arr::get($item, 'img'), $contents);
                $dish->img = $dst_path . DIRECTORY_SEPARATOR . Arr::get($item, 'img');
            }

            $dish->price = $item['price'];
            $dish->visible = $item['visible'];
            $dish->save();
        }
    }
}
