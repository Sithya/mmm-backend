<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Concerns\HandlesApiQueries;
use App\Models\Organization;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    use HandlesApiQueries;

    /**
     * Get all organizations
     */
    public function index(Request $request): JsonResponse
    {
        $query = Organization::query();
        $query = $this->applyQueryFilters($query, $request, [
            'default_sort' => 'created_at',
            'default_order' => 'desc',
            'filter_by_page_id' => true,
        ]);

        $result = $this->getPaginatedOrAll($query, $request);

        if ($result instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator) {
            return ApiResponse::paginated($result);
        }

        return ApiResponse::success($result);
    }

    /**
     * Get an organization by ID
     */
    public function show(Organization $organization): JsonResponse
    {
        return ApiResponse::success($organization);
    }

    /**
     * Create a new organization
     */
    public function store(CreateOrganizationRequest $request): JsonResponse
    {
        $organization = Organization::create($request->validated());
        return ApiResponse::success($organization, 'Organization created successfully', 201);
    }

    /**
     * Update an existing organization
     */
    public function update(UpdateOrganizationRequest $request, Organization $organization): JsonResponse
    {
        $organization->update($request->validated());
        return ApiResponse::success($organization->fresh(), 'Organization updated successfully');
    }
    
    /**
     * Delete an organization
     */
    public function destroy(Organization $organization): JsonResponse
    {
        $organization->delete();
        return ApiResponse::success(null, 'Organization deleted successfully', 204);
    }

    // Update category name
    public function updateCategory(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'old_category' => 'required|string|max:255',
            'new_category' => 'required|string|max:255'
        ]);
        
        Organization::where('category', $validated['old_category'])
            ->update(['category' => $validated['new_category']]);
            
        $updated = Organization::where('category', $validated['new_category'])->get();
        return ApiResponse::success($updated, 'Category updated successfully');
    }

    // Delete category name and its members
    public function deleteCategory(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255'
        ]);
        
        Organization::where('category', $validated['category'])->delete();
        return ApiResponse::success(null, 'Category and its members deleted successfully', 204);
    }
}
