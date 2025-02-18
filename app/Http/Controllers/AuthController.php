<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\UserEcom;

class AuthController extends Controller
{
    // Handle User Registration
    public function register(Request $request) {
        $request->validate([
            'username' => 'required|unique:users_ecom',
            'email' => 'required|email|unique:users_ecom',
            'dob' => 'required|date',
            'password' => 'required|min:6|confirmed',
        ]);

        UserEcom::create([
            'username' => $request->username,
            'email' => $request->email,
            'dob' => $request->dob,
            'password' => ($request->password),
        ]);

        return redirect('/login')->with('success', 'Account created! Please log in.');
    }

    // Handle User Login
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect('/')->with('success', 'Logged in successfully!');
        }

        return back()->withErrors(['email' => 'Invalid email or password.']);
    }

    // Handle User Logout
    public function logout() {
        Auth::logout();
        return redirect('/login')->with('success', 'Logged out successfully!');
    }
}
