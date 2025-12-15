<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Helpers\ApiResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return ApiResponse::success(
            [
                'user' => $user,
                'token' => $token,
            ],
            'User registered successfully',
            201
        );
    }

    /**
     * Login user
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return ApiResponse::error(
                'AUTHENTICATION_FAILED',
                'Invalid credentials',
                null,
                401
            );
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return ApiResponse::success(
            [
                'user' => $user,
                'token' => $token,
            ],
            'Login successful'
        );
    }

    /**
     * Logout user
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return ApiResponse::success(null, 'Logged out successfully');
    }

    /**
     * Refresh the current access token
     */
    public function refresh(Request $request): JsonResponse
    {
        $user = $request->user();

        // Revoke current token and issue a new one
        if ($token = $user?->currentAccessToken()) {
            $token->delete();
        }

        $newToken = $user->createToken('auth_token')->plainTextToken;

        return ApiResponse::success(
            [
                'user' => $user,
                'token' => $newToken,
            ],
            'Token refreshed successfully'
        );
    }

    /**
     * Get authenticated user
     */
    public function me(Request $request): JsonResponse
    {
        return ApiResponse::success($request->user());
    }
}

