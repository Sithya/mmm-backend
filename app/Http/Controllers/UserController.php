<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Helpers\ApiResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Get all users
     */
    public function index(): JsonResponse
    {
        $perPage = request('per_page', 15);
        $users = User::paginate(min($perPage, 100));

        return ApiResponse::paginated($users);
    }

    /**
     * Get a single user
     */
    public function show($id): JsonResponse
    {
        $user = User::with('register')->findOrFail($id);

        return ApiResponse::success($user);
    }

    /**
     * Create a new user
     */
    public function store(CreateUserRequest $request): JsonResponse
    {
        $data = $request->validated();
        
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user = User::create($data);

        return ApiResponse::success(
            $user,
            'User created successfully',
            201
        );
    }

    /**
     * Update a user
     */
    public function update(UpdateUserRequest $request, $id): JsonResponse
    {
        $user = User::findOrFail($id);
        $data = $request->validated();

        if (isset($data['password']) && $data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return ApiResponse::success(
            $user->fresh(),
            'User updated successfully'
        );
    }

    /**
     * Delete a user
     */
    public function destroy($id): JsonResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return ApiResponse::success(
            null,
            'User deleted successfully',
            204
        );
    }
}

