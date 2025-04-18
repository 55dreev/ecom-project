<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Get the currently logged-in user
        return view('account', compact('user')); // Pass user data to the view
    }
}