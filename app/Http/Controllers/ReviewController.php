<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        // ✅ Fetch main reviews and their replies
        $reviews = Review::whereNull('parent_id')
                         ->with('replies')
                         ->orderBy('created_at', 'desc')
                         ->get();

        // ✅ Calculate the average rating (ignoring 0-rated reviews)
        $averageRating = Review::where('rating', '>', 0)->avg('rating');

        return view('welcome', compact('reviews', 'averageRating')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'comment' => 'required|string',
            'rating' => 'required|numeric|min:0|max:5', // ✅ Validate rating input (0 to 5)
            'parent_id' => 'nullable|integer|exists:reviews,id',
        ]);

        Review::create([
            'name' => $request->name,
            'comment' => $request->comment,
            'rating' => $request->rating, // ✅ Save rating
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully!');
    }
}
