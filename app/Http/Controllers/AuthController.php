<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
            return redirect()->intended('/account'); // Redirect to account page after login
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
        Auth::logout(); // Logout user
        $request->session()->invalidate(); // Invalidate session
        $request->session()->regenerateToken(); // Prevent CSRF attacks

        return redirect('/'); // Redirect to homepage after logout
    }
}
