<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Costume;
use App\Models\Review;

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
        $averageRating = Review::where('costume_id', $id)->avg('rating') ?? 0;

        return view('product-details', compact('costume', 'reviews', 'averageRating'));
    }
}