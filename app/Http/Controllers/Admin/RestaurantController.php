<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
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
        'p_iva' => 'required|max:11',
        'logo' => 'nullable|image|max:2048',
        'bg_image' => 'nullable|image|max:2048',
        'shipping' => 'required|numeric|max:99.99',
        'shipping_free' => 'nullable|numeric|max:999.99',
        'vote' => 'nullable|numeric|between:1,5',
        'slug' => 'unique:restaurants|max:80',
    ];

    private function generateSlug($data)
    {
        $slug = Str::slug($data["name"], '-');

        $existingRestaurant = Restaurant::where('name', $data["name"])->get();

        if (!$existingRestaurant) {
            return $slug . "-1";
        }

        $howMany = count($existingRestaurant);

        $slugBase = $slug;
        while ($existingRestaurant) {
            $howMany++;
            $slug = $slugBase . "-" . $howMany;

            $existingRestaurant = Restaurant::where('slug', $slug)->first();
        }

        return $slug;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $restaurants = Restaurant::all();
        $restaurants = Restaurant::orderBy('id', 'DESC')->paginate(10);
        return view('admin.restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.restaurants.create', compact('types'));
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
        // $data['user_id'] = USER_ID!!!!;

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
        return view("admin.restaurants.show", compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $types = Type::all();
        return view('admin.restaurants.edit', compact('types'));
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

        $request->validate($this->restaurantValidationArray);

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

        $restaurant->delete();

        return redirect()
            ->route('admin.restaurants.index')
            ->with('deleted', "Ristorante '" . $restaurant->name . "' eliminato!");
    }
}
