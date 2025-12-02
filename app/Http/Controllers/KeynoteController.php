<?php

namespace App\Http\Controllers;

use App\Models\Keynote;
use Illuminate\Http\Request;

class KeynoteController extends Controller
{
    // Get all keynotes
    public function index()
    {
        $keynotes = Keynote::all();
        return response()->json($keynotes);
    }

    // Get keynotes by Page ID
    public function indexByPage($pageId)
    {
        $keynotes = Keynote::where('page_id', $pageId)->get();
        return response()->json($keynotes);
    }

    // Get a keynote by ID
    public function show($id){
        $keynote = Keynote::findOrFail($id);
        return response()->json($keynote);
    }

    // Create a new keynote
    public function store(Request $request){
        $validated = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'photo_url' => 'nullable|string|max:255',
            'affiliation' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'content' => 'nullable|string',
        ]);
        $keynote = Keynote::create($validated);
        return response()->json($keynote, 201);
    }

    // Update an existing keynote
    public function update(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'photo_url' => 'nullable|string|max:255',
            'affiliation' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'content' => 'nullable|string',
        ]);
        $keynote = Keynote::findOrFail($id);
        $keynote->update($validated);
        return response()->json($keynote);
    }

    // Delete a keynote
    public function destroy($id){
        $keynote = Keynote::findOrFail($id);
        $keynote->delete();
        return response()->json(null, 204); 
    }
}
