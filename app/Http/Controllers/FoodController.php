<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foods = Food::latest()->paginate(5);
        return view('food.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('food.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'category' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);

        $image = $request->file('image');
        $name = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $name);

        Food::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'category_id' => $request->get('category'),
            'image' => $name,
        ]);

        return redirect()->back()->with('message', 'Food berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $food = Food::find($id);
        return view('food.edit', compact('food'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'category' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);

        $food = Food::find($id);
        $name = $food->image;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
        }

        $food->name = $request->get('name');
        $food->description = $request->get('description');
        $food->price = $request->get('price');
        $food->category_id = $request
            ->get('category');
        $food->image = $name;
        $food->save();

        return redirect()->route('food.index')->with('message', 'Food berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Food::find($id)->delete();
        return redirect()->route('food.index')->with('message', 'Food berhasil dihapus');
    }
}
