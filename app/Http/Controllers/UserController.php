<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Register function to create a new user
    public function register(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'email' => 'required|string|max:255|unique:email', //Email must be unique
            'username' => 'required|string|max:255|unique:users',  // Username must be unique
            'password' => 'required|string|min:6',  // Password must be at least 6 characters
        ]);

        // Create a new user with hashed password
        $user = User::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),  // Hash the password
        ]);

        // Respond with success message
        return response()->json(['message' => 'User registered successfully'], 201);
    }

    // Login function to authenticate user
    public function login(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        // Attempt to find the user by username
        $user = User::where('username', $validated['username'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            // If no user is found or password doesn't match
            return response()->json(['message' => 'Invalid username or password'], 401);
        }

        // Successfully authenticated

        return response()->json(['message' => 'Login successful'], 200);
    }
}
