<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Category;

class CategoryController extends Controller
{
    public function getCategories() {
        $categories = Category::all();

        return response()->json($categories);
    }
}
