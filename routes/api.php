<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroceryController;


Route::get('/', function () {
    return response()->json(['message' => 'This Endpoint Is Alive']); // Test Endpoint
});

Route::post('/login', [UserController::class, "login"]); // Login

Route::post('/register', [UserController::class, "register"]); // Register

Route::prefix('groceries')->group(function () {
    Route::post('/', [GroceryController::class, 'create']); // Create a new grocery item
    Route::get('/', [GroceryController::class, 'index']); // Get all grocery items
    Route::get('{id}', [GroceryController::class, 'show']); // Get a single grocery item by ID
    Route::patch('{id}', [GroceryController::class, 'update']); // Update a grocery item by ID (PATCH)
    Route::delete('{id}', [GroceryController::class, 'destroy']); // Delete a grocery item
    Route::post('user', [GroceryController::class, 'showByUsername']); // Get groceries by username
});