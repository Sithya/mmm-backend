<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRegisterRequest;
use App\Http\Requests\UpdateRegisterRequest;
use App\Helpers\ApiResponse;
use App\Models\Register;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Get all registrations
     */
    public function index(): JsonResponse
    {
        $perPage = request('per_page', 15);
        $registrations = Register::with('user')->paginate(min($perPage, 100));

        return ApiResponse::paginated($registrations);
    }

    /**
     * Get registrations by user ID
     */
    public function indexByUser($userId): JsonResponse
    {
        $registrations = Register::where('user_id', $userId)
            ->with('user')
            ->get();

        return ApiResponse::success($registrations);
    }

    /**
     * Get the current authenticated user's registration
     */
    public function showForCurrentUser(Request $request): JsonResponse
    {
        $user = $request->user();

        $registration = Register::where('user_id', $user->id)
            ->with('user')
            ->first();

        if (! $registration) {
            return ApiResponse::error(
                'RESOURCE_NOT_FOUND',
                'No registration found for this user.',
                null,
                404
            );
        }

        return ApiResponse::success($registration);
    }

    /**
     * Get a single registration
     */
    public function show($id): JsonResponse
    {
        $register = Register::with('user')->findOrFail($id);

        return ApiResponse::success($register);
    }

    /**
     * Create a new registration
     */
    public function store(CreateRegisterRequest $request): JsonResponse
    {
        // Check if user already has a registration
        $existing = Register::where('user_id', $request->user_id)->first();
        
        if ($existing) {
            return ApiResponse::error(
                'DUPLICATE_ENTRY',
                'User already has a registration',
                null,
                422
            );
        }

        $register = Register::create($request->validated());

        return ApiResponse::success(
            $register->load('user'),
            'Registration created successfully',
            201
        );
    }

    /**
     * Create a registration for the current authenticated user
     */
    public function storeForCurrentUser(Request $request): JsonResponse
    {
        $user = $request->user();

        // Check if user already has a registration
        $existing = Register::where('user_id', $user->id)->first();
        
        if ($existing) {
            return ApiResponse::error(
                'REGISTRATION_ALREADY_EXISTS',
                'You already have a registration.',
                null,
                422
            );
        }

        $data = $request->validate([
            'type' => 'required|string|max:255',
        ]);

        $register = Register::create([
            'user_id' => $user->id,
            'type' => $data['type'],
        ]);

        return ApiResponse::success(
            $register->load('user'),
            'Registration created successfully',
            201
        );
    }

    /**
     * Update a registration
     */
    public function update(UpdateRegisterRequest $request, $id): JsonResponse
    {
        $register = Register::findOrFail($id);
        $register->update($request->validated());

        return ApiResponse::success(
            $register->fresh()->load('user'),
            'Registration updated successfully'
        );
    }

    /**
     * Delete a registration
     */
    public function destroy($id): JsonResponse
    {
        $register = Register::findOrFail($id);
        $register->delete();

        return ApiResponse::success(
            null,
            'Registration deleted successfully',
            204
        );
    }

    /**
     * Cancel the current authenticated user's registration
     */
    public function destroyForCurrentUser(Request $request): JsonResponse
    {
        $user = $request->user();

        $register = Register::where('user_id', $user->id)->first();

        if (! $register) {
            return ApiResponse::error(
                'RESOURCE_NOT_FOUND',
                'No registration found for this user.',
                null,
                404
            );
        }

        $register->delete();

        return ApiResponse::success(
            null,
            'Registration cancelled successfully',
            204
        );
    }
}

