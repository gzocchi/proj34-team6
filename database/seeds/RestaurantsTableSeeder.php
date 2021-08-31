<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use App\Restaurant;

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
        $img_path = base_path() . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'restaurants';
        $dst_path = 'restaurants';

        foreach ($restaurants as $item) {

            $restaurant = new Restaurant();

            $admin = App\User::where('email', 'admin@deliveboo.com')->first();
            $restaurant->user_id = $admin->id;

            $restaurant->name = $item['name'];
            $restaurant->address = $item['address'];
            $restaurant->p_iva = $item['p_iva'];

            if (Arr::has($item, 'logo')) {
                $contents = file_get_contents($img_path . DIRECTORY_SEPARATOR . Arr::get($item, 'logo'));
                Storage::put($dst_path . DIRECTORY_SEPARATOR . Arr::get($item, 'logo'), $contents);
                $restaurant->logo = $dst_path . DIRECTORY_SEPARATOR . Arr::get($item, 'logo');
            }
            if (Arr::has($item, 'bg_image')) {
                $contents = file_get_contents($img_path . DIRECTORY_SEPARATOR . Arr::get($item, 'bg_image'));
                Storage::put($dst_path . DIRECTORY_SEPARATOR . Arr::get($item, 'bg_image'), $contents);
                $restaurant->bg_image = $dst_path . DIRECTORY_SEPARATOR . Arr::get($item, 'bg_image');
            }

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
