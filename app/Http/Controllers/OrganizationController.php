<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    // Get all organizations
    public function index()
    {
        $organizations = Organization::all();
        return response()->json($organizations);
    }

    // Get organizations by Page ID
    public function indexByPage($pageId)
    {
        $organizations = Organization::where('page_id', $pageId)->get();
        return response()->json($organizations);
    }

    // Get an organization by ID
    public function show($id)
    {
        $organization = Organization::findOrFail($id);
        return response()->json($organization);
    }

    // Create a new organization
    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'photo_url' => 'nullable|string|max:255',
            'affiliation' => 'nullable|string|max:255',
        ]);

        $organization = Organization::create($validated);

        return response()->json($organization, 201);
    }

    // Update an existing organization
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'photo_url' => 'nullable|string|max:255',
            'affiliation' => 'nullable|string|max:255',
        ]);

        $organization = Organization::findOrFail($id);
        $organization->update($validated);

        return response()->json($organization);
    }
    
    // Delete an organization
    public function destroy($id)
    {
        $organization = Organization::findOrFail($id);
        $organization->delete();
        return response()->json(null, 204);
    }
}
