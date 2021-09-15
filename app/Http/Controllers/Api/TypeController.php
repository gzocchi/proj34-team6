<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Type;

class TypeController extends Controller
{
    // paginazione da 12 
    public function index() {

        $types = Type::paginate(12);

        return response()->json($types);
    }

    public function indexSix() {

        $types = Type::paginate(6);

        return response()->json($types);
    }

    // paginazione da 4 
    public function indexFour() {

        $types = Type::paginate(4);

        return response()->json($types);
    }
    // paginazione da 3 
    public function indexThree() {

        $types = Type::paginate(3);

        return response()->json($types);
    }

    public function show($slug) {

        $type = Type::where('slug', $slug)->with(['restaurants'])->first();

        return response()->json($type);

    }
}
