<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\UserEcom;
use Illuminate\Support\Facades\DB;

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
    public function login(Request $request)
    {
        // Validate the login form input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Query the database to find the user by email
        $user = DB::table('users_ecom')->where('email', $request->email)->first();

        if ($user && $user->password == $request->password) {
            // The user exists and the password matches
            // Log the user in (you can store their username in session)
            session(['username' => $user->username]);

            // Redirect to homepage after successful login
            return redirect()->route('homepage');
        } else {
            // If login fails, redirect back with an error message
            return back()->withErrors(['email' => 'Invalid email or password']);
        }
    }

    
    

    // Handle User Logout
    public function logout()
{
    session()->forget('username'); // Clear the session data for username
    return redirect()->route('homepage'); // Redirect to the homepage
}

}
