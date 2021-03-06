<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use App\Restaurant;
use App\User;
use App\Type;
use App\Dish;

class RestaurantController extends Controller
{

    private $restaurantValidationArray = [
        'user_id' => 'exists:users,id',
        'name' => 'required|max:60',
        'address' => 'required|max:255',
        'p_iva' => 'required|digits:11|unique:restaurants',
        'logo' => 'nullable|image|max:2048',
        'bg_image' => 'nullable|image|max:2048',
        'shipping' => 'required|numeric|between:0,99.99',
        'shipping_free' => 'nullable|numeric|between:0,999.99',
        'slug' => 'unique:restaurants|max:80',
    ];

    private function generateSlug($data)
    {
        $slug = Str::slug($data["name"], '-');

        $existingRestaurant = Restaurant::where('slug', $slug)->first();

        if (!$existingRestaurant) {
            return $slug;
        }

        $counter = 1;
        $slugBase = $slug;

        while ($existingRestaurant) {
            $counter++;
            $slug = $slugBase . "-" . $counter;
            $existingRestaurant = Restaurant::where('slug', $slug)->first();
        }

        return $slug;
    }

    public function getUserId()
    {
        $user = Auth::user();
        return $user->id;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::where('user_id', $this->getUserId())->get();
        return view('admin.restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurant = Restaurant::where('user_id', $this->getUserId())->first();

        if (!$restaurant) {
            $types = Type::all();
            return view('admin.restaurants.create', compact('types'));
        } else {
            return redirect()->route("admin.home");
        }
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

        $request->validate($this->restaurantValidationArray);

        $newRestaurant = new Restaurant();

        $data['user_id'] = $this->getUserId();

        $slug = $this->generateSlug($data);
        $data['slug'] = $slug;

        if (Arr::has($data, 'logo')) {
            $data["logo"] = Storage::put('restaurants', $data["logo"]);
        }
        if (Arr::has($data, 'bg_image')) {
            $data["bg_image"] = Storage::put('restaurants', $data["bg_image"]);
        }

        $newRestaurant->fill($data);
        $newRestaurant->save();

        if (Arr::has($data, 'types')) {
            $newRestaurant->types()->attach($data["types"]);
        }

        // return redirect()->route('admin.restaurants.show', $newRestaurant->id);
        return redirect()->route('admin.restaurants.show', $newRestaurant->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        if ($restaurant->user_id == $this->getUserId()) {
            $restaurant = Restaurant::where('user_id', $this->getUserId())->first();
            return view('admin.restaurants.show', compact('restaurant'));
        } else {
            return view("admin.home");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        if ($restaurant->user_id == $this->getUserId()) {
            $types = Type::all();
            return view('admin.restaurants.edit', compact('restaurant', 'types'));
        } else {
            return redirect()->route("admin.home");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $data = $request->all();

        // $request->validate($this->restaurantValidationArray);
        $request->validate(
            [
                $this->restaurantValidationArray,
                'p_iva' => [
                    Rule::unique('restaurants')->ignore($restaurant->id)
                ]
            ],
            [
                'p_iva.unique' => 'Partita IVA esistente',
                'required' => ':attribute ?? un campo obbligatorio!'
            ]
        );

        if (Str::lower($restaurant->name) != Str::lower($data["name"])) {
            $slug = $this->generateSlug($data);
            $data["slug"] = $slug;
        }

        if (Arr::has($data, 'logo')) {
            if ($restaurant->logo) {
                Storage::delete($restaurant->logo);
            }
            $data["logo"] = Storage::put('restaurants', $data["logo"]);
        }
        if (Arr::has($data, 'bg_image')) {
            if ($restaurant->bg_image) {
                Storage::delete($restaurant->bg_image);
            }
            $data["bg_image"] = Storage::put('restaurants', $data["bg_image"]);
        }

        $restaurant->update($data);

        if (Arr::has($data, 'types')) {
            $restaurant->types()->sync($data["types"]);
        } else {
            $restaurant->types()->detach();
        }

        return redirect()->route('admin.restaurants.show', $restaurant->id);
        // return redirect()->route('admin.restaurants.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        if ($restaurant->logo) {
            Storage::delete($restaurant->logo);
        }
        if ($restaurant->bg_image) {
            Storage::delete($restaurant->bg_image);
        }

        if (count($restaurant->dishes) === 1) {
            if($restaurant->dishes->first()->img){
                Storage::delete($restaurant->dishes->first()->img);
            }
            $restaurant->dishes()->delete();
        } elseif (count($restaurant->dishes) > 1) {
            $allDish = $restaurant->dishes()->get();
            foreach ($allDish as $singleDish) {
                Storage::delete($singleDish->img);
            }
            $restaurant->dishes()->delete();
        }

        $restaurant->delete();

        return redirect()
            ->route('admin.home')
            ->with('deleted', "Ristorante '" . $restaurant->name . "' eliminato!");
    }
}
