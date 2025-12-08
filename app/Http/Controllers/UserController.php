<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
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

        return response()->json([
            'success' => true,
            'data' => [
                'items' => $users->items(),
                'pagination' => [
                    'current_page' => $users->currentPage(),
                    'per_page' => $users->perPage(),
                    'total' => $users->total(),
                    'last_page' => $users->lastPage(),
                    'from' => $users->firstItem(),
                    'to' => $users->lastItem(),
                ],
            ],
        ]);
    }

    /**
     * Get a single user
     */
    public function show($id): JsonResponse
    {
        $user = User::with('register')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $user,
        ]);
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

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'User created successfully',
        ], 201);
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

        return response()->json([
            'success' => true,
            'data' => $user->fresh(),
            'message' => 'User updated successfully',
        ]);
    }

    /**
     * Delete a user
     */
    public function destroy($id): JsonResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully',
        ], 204);
    }
}

