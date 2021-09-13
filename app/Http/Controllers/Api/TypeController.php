<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Type;

class TypeController extends Controller
{
    public function index() {

        $types = Type::paginate(12);

        return response()->json($types);
    }

    public function show($slug) {

        $type = Type::where('slug', $slug)->with(['restaurants'])->first();

        return response()->json($type);

    }
}
