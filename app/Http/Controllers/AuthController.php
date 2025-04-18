<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserEcom;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Handle user registration.
     */
    public function register(Request $request)
{
    // ✅ Validate input
    $validatedData = $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ]);

    // ✅ Create the user
    $user = User::create([
        'name' => $validatedData['username'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']), // ✅ Hash the password
    ]);

    // ✅ Debug: Check if the user is saved
    if ($user) {
        return redirect('/login')->with('success', 'Account created! Please log in.');
    } else {
        return back()->with('error', 'Failed to create account. Try again.');
    }
}
    /**
     * Handle user login.
     */
    public function login(Request $request)
{
    // Validate login input
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // Attempt login
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate(); // Prevent session fixation attacks

        // Check if the user is the admin
        if (auth()->user()->email === 'admin@suitup.com') {
            return redirect('/admin-products'); // ✅ change this to your admin dashboard route
        }

        // Regular user
        return redirect()->intended('/account');
    }

    // If login fails, return with error
    return back()->withErrors([
        'email' => 'Invalid credentials.',
    ])->onlyInput('email');
}

    /**
     * Handle user logout.
     */
    public function logout(Request $request)
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


}
