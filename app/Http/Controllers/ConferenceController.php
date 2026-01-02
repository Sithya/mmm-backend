<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateConferenceRequest;
use App\Http\Requests\UpdateConferenceRequest;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Concerns\HandlesApiQueries;
use App\Models\Conference;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    use HandlesApiQueries;

    /**
     * Get all conferences
     */
    public function index(Request $request): JsonResponse
    {
        $query = Conference::query();
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
     * Get a conference by ID
     */
    public function show(Conference $conference): JsonResponse
    {
        return ApiResponse::success($conference);
    }

    /**
     * Create a new conference
     */
    public function store(CreateConferenceRequest $request): JsonResponse
    {
        $conference = Conference::create($request->validated());
        return ApiResponse::success($conference, 'Conference created successfully', 201);
    }

    /**
     * Update an existing conference
     */
    public function update(UpdateConferenceRequest $request, Conference $conference): JsonResponse
    {
        $conference->update($request->validated());
        return ApiResponse::success($conference->fresh(), 'Conference updated successfully');
    }

    /**
     * Delete a conference
     */
    public function destroy(Conference $conference): JsonResponse
    {
        $conference->delete();
        return ApiResponse::success(null, 'Conference deleted successfully', 204);
    }
}
