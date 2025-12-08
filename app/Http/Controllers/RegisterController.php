<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRegisterRequest;
use App\Http\Requests\UpdateRegisterRequest;
use App\Models\Register;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    /**
     * Get all registrations
     */
    public function index(): JsonResponse
    {
        $perPage = request('per_page', 15);
        $registrations = Register::with('user')->paginate(min($perPage, 100));

        return response()->json([
            'success' => true,
            'data' => [
                'items' => $registrations->items(),
                'pagination' => [
                    'current_page' => $registrations->currentPage(),
                    'per_page' => $registrations->perPage(),
                    'total' => $registrations->total(),
                    'last_page' => $registrations->lastPage(),
                    'from' => $registrations->firstItem(),
                    'to' => $registrations->lastItem(),
                ],
            ],
        ]);
    }

    /**
     * Get registrations by user ID
     */
    public function indexByUser($userId): JsonResponse
    {
        $registrations = Register::where('user_id', $userId)
            ->with('user')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $registrations,
        ]);
    }

    /**
     * Get a single registration
     */
    public function show($id): JsonResponse
    {
        $register = Register::with('user')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $register,
        ]);
    }

    /**
     * Create a new registration
     */
    public function store(CreateRegisterRequest $request): JsonResponse
    {
        // Check if user already has a registration
        $existing = Register::where('user_id', $request->user_id)->first();
        
        if ($existing) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'DUPLICATE_ENTRY',
                    'message' => 'User already has a registration',
                ],
            ], 422);
        }

        $register = Register::create($request->validated());

        return response()->json([
            'success' => true,
            'data' => $register->load('user'),
            'message' => 'Registration created successfully',
        ], 201);
    }

    /**
     * Update a registration
     */
    public function update(UpdateRegisterRequest $request, $id): JsonResponse
    {
        $register = Register::findOrFail($id);
        $register->update($request->validated());

        return response()->json([
            'success' => true,
            'data' => $register->fresh()->load('user'),
            'message' => 'Registration updated successfully',
        ]);
    }

    /**
     * Delete a registration
     */
    public function destroy($id): JsonResponse
    {
        $register = Register::findOrFail($id);
        $register->delete();

        return response()->json([
            'success' => true,
            'message' => 'Registration deleted successfully',
        ], 204);
    }
}

