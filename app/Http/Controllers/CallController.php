<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCallRequest;
use App\Http\Requests\UpdateCallRequest;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Concerns\HandlesApiQueries;
use App\Models\Call;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CallController extends Controller
{
    use HandlesApiQueries;

    /**
     * Get all calls
     */
    public function index(Request $request): JsonResponse
    {
        $query = Call::query();
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
     * Get a call by ID
     */
    public function show(Call $call): JsonResponse
    {
        return ApiResponse::success($call);
    }

    /**
     * Create a new call
     */
    public function store(CreateCallRequest $request): JsonResponse
    {
        $call = Call::create($request->validated());
        return ApiResponse::success($call, 'Call created successfully', 201);
    }

    /**
     * Update an existing call
     */
    public function update(UpdateCallRequest $request, Call $call): JsonResponse
    {
        $call->update($request->validated());
        return ApiResponse::success($call->fresh(), 'Call updated successfully');
    }

    /**
     * Delete a call
     */
    public function destroy(Call $call): JsonResponse
    {
        $call->delete();
        return ApiResponse::success(null, 'Call deleted successfully', 204);
    }
}
