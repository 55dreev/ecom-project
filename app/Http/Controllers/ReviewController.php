<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'comment' => 'required|string',
            'parent_id' => 'nullable|exists:reviews,id',
        ]);

        Review::create($request->all());

        return back()->with('success', 'Review submitted!');
    }

    public function index()
    {
        $reviews = Review::whereNull('parent_id')->with('replies')->get();
        return view('product', compact('reviews'));
    }
}
