<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = config('types');

        $img_path = base_path() . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'types';
        $dst_path = 'types';

        foreach ($types as $item) {
            $type = new Type();
            
            $type->name = $item['name'];
            $type->slug = Str::slug($item['name'], '-');

            if (Arr::has($item, 'image')) {
                $contents = file_get_contents($img_path . DIRECTORY_SEPARATOR . Arr::get($item, 'image'));
                Storage::put($dst_path . DIRECTORY_SEPARATOR . Arr::get($item, 'image'), $contents);
                $type->image = $dst_path . DIRECTORY_SEPARATOR . Arr::get($item, 'image');
            }

            $type->save();
        }
    }
}
