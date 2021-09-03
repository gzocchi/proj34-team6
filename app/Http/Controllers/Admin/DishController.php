<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use App\Dish;
use App\Restaurant;
use App\User;

class DishController extends Controller
{
    private $dishValidationArray = [
        'restaurant_id' => 'exists:restaurant,id',
        'category_id' => 'exists:category,id',
        'name' => 'required|max:100',
        'description' => 'nullable',
        'img' => 'nullable|image|max:2048',
        'price' => 'required|numeric|max:999.99',
        'visible' => 'boolean',
    ];

    public function getRestaurantId() {
        $user = Auth::user();
        $restaurant = Restaurant::where('user_id', $user->id)->first();
        return $restaurant->id;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $dishes = Dish::where('restaurant_id', $this->getRestaurantId())->get();
        return view('admin.dishes.index', compact('dishes', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.dishes.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        $request->validate($this->dishValidationArray);

        
        $data['restaurant_id'] = $this->getRestaurantId();
        // $data['category_id'] = intval($data['category_id']);
        $data['visible'] = boolval($data['visible']);
        $data['price'] = floatval($data['price']);

        
        $newDish = new Dish();
        
        if (Arr::has($data, 'img')) {
            $data["img"] = Storage::put('dishes', $data["img"]);
        } else {
            $data["img"] = 'images/placeholder_dish.svg';
        }

        $newDish->fill($data);
        $newDish->save();

        if (Arr::has($data, 'category_id')) {
            $newDish->category()->attach($data["category_id"]);
        }
        // return view("admin.dishes.edit" , compact('data'));
        return redirect()->route('admin.dishes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        $category = Category::where('id', $dish->category_id)->firstOrFail();
        return view("admin.dishes.show", compact('dish', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        //
    }
}
