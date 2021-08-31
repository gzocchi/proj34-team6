<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Type;
use Illuminate\Support\Str;

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

        $img_path = base_path().DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'types';
        $dst_path = 'types';

        foreach ($types as $item) {
            $contents = file_get_contents($img_path.DIRECTORY_SEPARATOR.$item['image']);
            Storage::put($dst_path.DIRECTORY_SEPARATOR.$item['image'], $contents);

            $type = new Type();

            $type->name = $item['name'];
            $type->slug = Str::slug($item['name'], '-');
            $type->image = $dst_path.DIRECTORY_SEPARATOR.$item['image'];

            $type->save();
        }
    }
}
