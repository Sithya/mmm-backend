<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateImportantDateRequest;
use App\Http\Requests\UpdateImportantDateRequest;
use App\Helpers\ApiResponse;
use App\Models\ImportantDate;
use Illuminate\Http\JsonResponse;

class ImportantDateController extends Controller
{
    /**
     * Get all important dates
     */
    public function index(): JsonResponse
    {
        $perPage = request('per_page', 15);
        $sort = request('sort', 'due_date');
        $order = request('order', 'asc');

        $importantDates = ImportantDate::orderBy($sort, $order)
            ->paginate(min($perPage, 100));

        return ApiResponse::paginated($importantDates);
    }

    /**
     * Get a single important date
     */
    public function show($id): JsonResponse
    {
        $importantDate = ImportantDate::findOrFail($id);

        return ApiResponse::success($importantDate);
    }

    /**
     * Create a new important date
     */
    public function store(CreateImportantDateRequest $request): JsonResponse
    {
        $importantDate = ImportantDate::create($request->validated());

        return ApiResponse::success(
            $importantDate,
            'Important date created successfully',
            201
        );
    }

    /**
     * Update an important date
     */
    public function update(UpdateImportantDateRequest $request, $id): JsonResponse
    {
        $importantDate = ImportantDate::findOrFail($id);
        $importantDate->update($request->validated());

        return ApiResponse::success(
            $importantDate->fresh(),
            'Important date updated successfully'
        );
    }

    /**
     * Delete an important date
     */
    public function destroy($id): JsonResponse
    {
        $importantDate = ImportantDate::findOrFail($id);
        $importantDate->delete();

        return ApiResponse::success(
            null,
            'Important date deleted successfully',
            204
        );
    }
}

