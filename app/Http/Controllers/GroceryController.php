<?php

namespace App\Http\Controllers;

use App\Models\Grocery;
use Illuminate\Http\Request;

class GroceryController extends Controller
{
    // Create: Store a new grocery item
    public function create(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'groceryName' => 'required|string|max:255',
            'groceryDescription' => 'nullable|string',
        ]);

        // Create the new grocery item
        $grocery = Grocery::create([
            'username' => $validated['username'],
            'groceryName' => $validated['groceryName'],
            'groceryDescription' => $validated['groceryDescription'],
        ]);

        return response()->json(['message' => 'Grocery item created successfully', 'data' => $grocery], 201);
    }

    // Read: Get all grocery items
    public function index()
    {
        // Fetch all grocery items
        $groceries = Grocery::all();

        return response()->json(['data' => $groceries], 200);
    }

    // Read: Get groceries based on the username
    public function showByUsername(Request $request)
    {
        // Validate incoming data (username is required)
        $validated = $request->validate([
            'username' => 'required|string|max:255',
        ]);

        // Fetch groceries based on the username
        $groceries = Grocery::where('username', $validated['username'])->get();

        // Check if groceries exist for the username
        if ($groceries->isEmpty()) {
            return response()->json(['message' => 'No groceries found for this username'], 404);
        }

        return response()->json(['data' => $groceries], 200);
    }

    // Read: Get a specific grocery item by ID
    public function show($id)
    {
        // Find the grocery item by ID
        $grocery = Grocery::find($id);

        if (!$grocery) {
            return response()->json(['message' => 'Grocery item not found'], 404);
        }

        return response()->json(['data' => $grocery], 200);
    }

    // Update: Update an existing grocery item using PATCH
    public function update(Request $request, $id)
    {
        // Validate incoming data
        $validated = $request->validate([
            'username' => 'nullable|string|max:255',
            'groceryName' => 'nullable|string|max:255',
            'groceryDescription' => 'nullable|string',
        ]);

        // Find the grocery item by ID
        $grocery = Grocery::find($id);

        if (!$grocery) {
            return response()->json(['message' => 'Grocery item not found'], 404);
        }

        // Update the fields (only the ones provided in the request)
        $grocery->update($validated);

        return response()->json(['message' => 'Grocery item updated successfully', 'data' => $grocery], 200);
    }

    // Delete: Remove a grocery item by ID
    public function destroy($id)
    {
        // Find the grocery item by ID
        $grocery = Grocery::find($id);

        if (!$grocery) {
            return response()->json(['message' => 'Grocery item not found'], 404);
        }

        // Delete the grocery item
        $grocery->delete();

        return response()->json(['message' => 'Grocery item deleted successfully'], 200);
    }
}
