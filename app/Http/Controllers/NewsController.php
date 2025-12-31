<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Get all news items
    public function index()
    {
        $query = News::query();
        
        // Filter by page_id if provided
        if (request()->has('page_id')) {
            $query->where('page_id', request('page_id'));
        }
        
        $news = $query->get();
        return response()->json($news);
    }

    // Get news items by Page ID
    public function indexByPage($pageId)
    {
        $news = News::where('page_id', $pageId)->get();
        return response()->json($news);
    }

    // Get a news item by ID
    public function show($id)
    {
        $newsItem = News::findOrFail($id);
        return response()->json($newsItem);
    }

    // Create a news item
    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'published_at' => 'nullable|date',
            'link_text' => 'nullable|string',
            'link_url' => 'nullable|string'
        ]);
        $newsItem = News::create($validated);
        return response()->json($newsItem, 201);
    }

    // Update a news item
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'nullable|string',
            'published_at' => 'nullable|date',
            'link_text' => 'nullable|string',
            'link_url' => 'nullable|string'
        ]);
        $newsItem = News::findOrFail($id);
        $newsItem->update($validated);
        return response()->json($newsItem);
    }

    // Delete a news item
    public function destroy($id)
    {
        $newsItem = News::findOrFail($id);
        $newsItem->delete();
        return response()->json(null, 204);
    }
}
