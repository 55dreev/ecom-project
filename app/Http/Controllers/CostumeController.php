<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Costume;
use App\Models\Review;
use Illuminate\Support\Facades\File;
class CostumeController extends Controller

{
    public function index()
    {
        $costumes = Costume::all(); // Fetch all costumes
        return view('categoriespage', compact('costumes')); // Pass to view
    }
    public function show($id)
    {
        $costume = Costume::findOrFail($id);

    // Fetch all reviews related to this costume
    $reviews = Review::where('costume_id', $id)
        ->whereNull('parent_id') // Get only main reviews, not replies
        ->with('replies') // Load replies
        ->latest()
        ->get();

    // Calculate the average rating for the costume
    $averageRating = Review::where('costume_id', $id)->avg('rating');

    return view('product-details', compact('costume', 'reviews', 'averageRating'));
    }
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        'description' => 'nullable|string',
    ]);

    $image = $request->file('image');
    $imageName = $image->getClientOriginalName();
    $imagePath = 'images/' . $imageName;

    // Check if image already exists
    if (!File::exists(public_path($imagePath))) {
        // Move the image to public/images only if it doesn't exist
        $image->move(public_path('images'), $imageName);
    }

    // Check if a costume with the same image already exists in the database
    $existingCostume = Costume::where('image', $imagePath)->first();
    
    if ($existingCostume) {
        return response()->json(['message' => 'Costume saved successfully!'], 201);

    }

    // Save the costume if it doesn't already exist
    $costume = new Costume();
    $costume->name = $request->name;
    $costume->price = $request->price;
    $costume->image = $imagePath;  // Store the relative path in the DB
    $costume->description = $request->description;
    $costume->save();

    return response()->json(['message' => 'Costume saved successfully!'], 201);

}
}
