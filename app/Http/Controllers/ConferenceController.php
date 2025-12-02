<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    // Get all conferences
    public function index()
    {
        $conferences = Conference::all();
        return response()->json($conferences);
    }

    // Get conferences by Page ID
    public function indexByPage($pageId)
    {
        $conferences = Conference::where('page_id', $pageId)->get();
        return response()->json($conferences);
    }

    // Get a conference by ID
    public function show($id)
    {
        $conference = Conference::findOrFail($id);
        return response()->json($conference);
    }

    // Create a new conference
    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'content' => 'nullable|string',
            'json' => 'nullable|json',
        ]);
        $conference = Conference::create($validated);
        return response()->json($conference, 201);
    }

    // Update an existing conference
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'content' => 'nullable|string',
            'json' => 'nullable|json',
        ]);
        $conference = Conference::findOrFail($id);
        $conference->update($validated);
        return response()->json($conference);
    }

    // Delete a conference
    public function destroy($id)
    {
        $conference = Conference::findOrFail($id);
        $conference->delete();
        return response()->json(null, 204);
    }
}
