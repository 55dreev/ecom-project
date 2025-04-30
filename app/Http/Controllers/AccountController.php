<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('account.edit', compact('user')); // Pass user data to the view
    }

    public function edit()
    {
        // Ensure the user is logged in
        $user = auth()->user();

        return view('account.edit', [
            'user' => auth()->user(),
          ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'phone'      => 'nullable|string|max:20',
            // you could also allow email/password changes here if you like...
        ]);

        $user->update($data);

        return back()->with('success', 'Your profile has been updated.');
    }
}