<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    protected $table = 'categories';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = config('categories');

        foreach ($categories as $item) {
            $category = new Category();
            $category->name = $item;
            $category->save();
        }
    }
}
