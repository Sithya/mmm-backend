<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Concerns\HandlesApiQueries;
use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PageController extends Controller
{
    use HandlesApiQueries;

    /**
     * Get all pages
     */
    public function index(Request $request): JsonResponse
    {
        $query = Page::query();
        $query = $this->applyQueryFilters($query, $request, [
            'default_sort' => 'id',
            'default_order' => 'asc',
            'filter_by_page_id' => false, // Pages don't have page_id
        ]);

        $result = $this->getPaginatedOrAll($query, $request);

        if ($result instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator) {
            return ApiResponse::paginated($result);
        }

        return ApiResponse::success($result);
    }

    /**
     * Get a page by ID
     */
    public function show(Page $page): JsonResponse
    {
        $page->load('calls', 'news', 'keynotes', 'organizations', 'conference', 'authors');
        return ApiResponse::success($page);
    }

    /**
     * Create a new page
     */
    public function store(CreatePageRequest $request): JsonResponse
    {
        $page = Page::create($request->validated());
        return ApiResponse::success($page, 'Page created successfully', 201);
    }

    /**
     * Update an existing page
     */
    public function update(UpdatePageRequest $request, Page $page): JsonResponse
    {
        $page->update($request->validated());
        return ApiResponse::success($page->fresh(), 'Page updated successfully');
    }

    /**
     * Delete a page
     */
    public function destroy(Page $page): JsonResponse
    {
        $page->delete();
        return ApiResponse::success(null, 'Page deleted successfully', 204);
    }

    /**
     * Get a page by slug
     */
    public function showBySlug(string $slug): JsonResponse
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return ApiResponse::success($page);
    }
}
