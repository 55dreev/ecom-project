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
        'costume_id' => 'required|exists:costumes,id',
        'name' => 'required|string|max:255',
        'comment' => 'required|string',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    Review::create([
        'costume_id' => $request->costume_id,
        'name' => $request->name,
        'comment' => $request->comment,
        'rating' => $request->rating,
    ]);

    return back()->with('success', 'Review added successfully!');
}
}
