<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // Get all authors
    public function index()
    {
        $authors = Author::all();
        return response()->json($authors);
    }

    // Get authors by Page ID
    public function indexByPage($pageId)
    {
        $authors = Author::where('page_id', $pageId)->get();
        return response()->json($authors);
    }

    // Get an author by ID
    public function show($id)
    {
        $author = Author::findOrFail($id);
        return response()->json($author);
    }

    // Create a new author
    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'content' => 'nullable|string',
        ]);
        $author = Author::create($validated);
        return response()->json($author, 201);
    }

    // Update an existing author
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'content' => 'nullable|string',
        ]);
        $author = Author::findOrFail($id);
        $author->update($validated);
        return response()->json($author);
    }

    // Delete an author
    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();
        return response()->json(null, 204);
    }
}
