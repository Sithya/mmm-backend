<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Concerns\HandlesApiQueries;
use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    use HandlesApiQueries;

    /**
     * Get all authors
     */
    public function index(Request $request): JsonResponse
    {
        $query = Author::query();
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
     * Get an author by ID
     */
    public function show(Author $author): JsonResponse
    {
        return ApiResponse::success($author);
    }

    /**
     * Create a new author
     */
    public function store(CreateAuthorRequest $request): JsonResponse
    {
        $author = Author::create($request->validated());
        return ApiResponse::success($author, 'Author created successfully', 201);
    }

    /**
     * Update an existing author
     */
    public function update(UpdateAuthorRequest $request, Author $author): JsonResponse
    {
        $author->update($request->validated());
        return ApiResponse::success($author->fresh(), 'Author updated successfully');
    }

    /**
     * Delete an author
     */
    public function destroy(Author $author): JsonResponse
    {
        $author->delete();
        return ApiResponse::success(null, 'Author deleted successfully', 204);
    }
}
