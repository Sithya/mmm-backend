<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKeynoteRequest;
use App\Http\Requests\UpdateKeynoteRequest;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Concerns\HandlesApiQueries;
use App\Models\Keynote;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KeynoteController extends Controller
{
    use HandlesApiQueries;

    /**
     * Get all keynotes
     */
    public function index(Request $request): JsonResponse
    {
        $query = Keynote::query();
        $query = $this->applyQueryFilters($query, $request, [
            'default_sort' => 'date',
            'default_order' => 'asc',
            'filter_by_page_id' => true,
        ]);

        $result = $this->getPaginatedOrAll($query, $request);

        if ($result instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator) {
            return ApiResponse::paginated($result);
        }

        return ApiResponse::success($result);
    }

    /**
     * Get a keynote by ID
     */
    public function show(Keynote $keynote): JsonResponse
    {
        return ApiResponse::success($keynote);
    }

    /**
     * Create a new keynote
     */
    public function store(CreateKeynoteRequest $request): JsonResponse
    {
        $keynote = Keynote::create($request->validated());
        return ApiResponse::success($keynote, 'Keynote created successfully', 201);
    }

    /**
     * Update an existing keynote
     */
    public function update(UpdateKeynoteRequest $request, Keynote $keynote): JsonResponse
    {
        $keynote->update($request->validated());
        return ApiResponse::success($keynote->fresh(), 'Keynote updated successfully');
    }

    /**
     * Delete a keynote
     */
    public function destroy(Keynote $keynote): JsonResponse
    {
        $keynote->delete();
        return ApiResponse::success(null, 'Keynote deleted successfully', 204);
    }
}
