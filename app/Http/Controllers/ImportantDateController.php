<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateImportantDateRequest;
use App\Http\Requests\UpdateImportantDateRequest;
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

        return response()->json([
            'success' => true,
            'data' => [
                'items' => $importantDates->items(),
                'pagination' => [
                    'current_page' => $importantDates->currentPage(),
                    'per_page' => $importantDates->perPage(),
                    'total' => $importantDates->total(),
                    'last_page' => $importantDates->lastPage(),
                    'from' => $importantDates->firstItem(),
                    'to' => $importantDates->lastItem(),
                ],
            ],
        ]);
    }

    /**
     * Get a single important date
     */
    public function show($id): JsonResponse
    {
        $importantDate = ImportantDate::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $importantDate,
        ]);
    }

    /**
     * Create a new important date
     */
    public function store(CreateImportantDateRequest $request): JsonResponse
    {
        $importantDate = ImportantDate::create($request->validated());

        return response()->json([
            'success' => true,
            'data' => $importantDate,
            'message' => 'Important date created successfully',
        ], 201);
    }

    /**
     * Update an important date
     */
    public function update(UpdateImportantDateRequest $request, $id): JsonResponse
    {
        $importantDate = ImportantDate::findOrFail($id);
        $importantDate->update($request->validated());

        return response()->json([
            'success' => true,
            'data' => $importantDate->fresh(),
            'message' => 'Important date updated successfully',
        ]);
    }

    /**
     * Delete an important date
     */
    public function destroy($id): JsonResponse
    {
        $importantDate = ImportantDate::findOrFail($id);
        $importantDate->delete();

        return response()->json([
            'success' => true,
            'message' => 'Important date deleted successfully',
        ], 204);
    }
}

