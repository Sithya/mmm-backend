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

    // Update category name
    public function updateCategory(Request $request) {
        $validated = $request->validate(
            ['old_category' => 'required|string|max:255',
            'new_category' => 'required|string|max:255']
        );
        Organization::where('category', $validated['old_category'])->update(['category'=>$validated['new_categgory']]);
        $updated = Organization::where('category', $validated['new_category'])->get();
        return response()->json($updated);
    }

    //Delete category name and its members
    public function deleteCategory(Request $request) {
        $validated = $request->validate(['category'=>'required|string|max:255']);
        Organization::where('category', $validated['category'])->delete();
        return response()->json(null, 204);
    }
}
