<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index() {

        $categories = Category::All();

        return response()->json($categories);
    }

    public function show($category_id) {

        $category = Category::where('id', $category_id)->first();

        return response()->json($category);
    }
}
