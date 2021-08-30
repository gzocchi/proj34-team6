<?php

use Illuminate\Database\Seeder;
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
        $types = ['Cinese', 'Pizza', 'Italiano'];

        foreach ($types as $item) {
            $type = new Type();

            $type->name = $item;
            $type->slug = Str::slug($item, '-');

            $type->save();
        }
    }
}
