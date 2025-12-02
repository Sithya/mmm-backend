<?php

namespace App\Http\Controllers;

use App\Models\Call;
use Illuminate\Http\Request;

class CallController extends Controller
{
    // Get all calls
    public function index()
    {
        $calls = Call::all();
        return response()->json($calls);
    }

    // Get calls by Page ID
    public function indexByPage($pageId)
    {
        $calls = Call::where('page_id', $pageId)->get();
        return response()->json($calls);
    }

    // Get a call by ID
    public function show($id)
    {
        $call = Call::findOrFail($id);
        return response()->json($call);
    }

    // Create a new call
    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'title' => 'required|string|max:255',
            'type' => 'nullable|string|unique:calls,type',
            'content' => 'nullable|string',
        ]);
        $call = Call::create($validated);
        return response()->json($call, 201);
    }

    // Update an existing call
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'type' => 'nullable|string|unique:calls,type,' . $id,
            'content' => 'nullable|string',
        ]);
        $call = Call::findOrFail($id);
        $call->update($validated);
        return response()->json($call);
    }

    // Delete a call
    public function destroy($id)
    {
        $call = Call::findOrFail($id);
        $call->delete();
        return response()->json(null, 204);
    }
}
