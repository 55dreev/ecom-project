<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Costume;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        // Handle Image Upload
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $imagePath = 'images/' . $imageName;
        $image->move(public_path('images'), $imageName);

        // Save to database
        $costume = new Costume();
        $costume->name = $request->name;
        $costume->price = $request->price;
        $costume->image = $imagePath;
        $costume->description = $request->description;
        $costume->save();

        return response()->json(['message' => 'Costume saved successfully!'], 201);

    }
}



