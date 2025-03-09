<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Costume;

class CostumeController extends Controller
{
    public function index()
    {
        $costumes = Costume::all(); // Fetch all costumes
        return view('categoriespage', compact('costumes')); // Pass to view
    }
}
