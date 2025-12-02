<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // Get all pages
    public function index() {
        $pages = Page::orderBy('id', 'asc')->get();
        return response()->json($pages);
    }

    // Get a page by id
    public function show($id) {
        $page = Page::findOrFail($id);
        $page->load('calls', 'news', 'keynotes', 'organization', 'conference', 'authors');
        return response()->json($page);
    }

    // Create a new page
    public function store(Request $request) {
        $page = Page::create($request->all());
        return response()->json($page, 201);
    }

    // Update an existing page by id
    public function update(Request $request, $id) {
        $page = Page::findOrFail($id);
        $page->update($request->all());
        return response()->json($page);
    }

    // Delete a page
    public function destroy($id) {
        $page = Page::findOrFail($id);
        $page->delete();
        return response()->json(null, 204);
    }
}
