<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\KeynoteController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ImportantDateController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API v1 routes
Route::prefix('v1')->group(function () {
    // Health check endpoint
    Route::get('/health', function () {
        return response()->json([
            'status' => 'ok',
            'timestamp' => now()->toIso8601String(),
            'version' => '1.0.0',
        ]);
    });

    // Public routes (CMS content)
    Route::get('pages/slug/{slug}', [PageController::class, 'showBySlug']);
    Route::apiResource('pages', PageController::class);
    Route::patch('organizations/category', [OrganizationController::class, 'updateCategory']);
    Route::delete('organizations/category', [OrganizationController::class, 'deleteCategory']);
    Route::apiResource('organizations', OrganizationController::class);
    Route::apiResource('authors', AuthorController::class);
    Route::apiResource('calls', CallController::class);
    Route::apiResource('conferences', ConferenceController::class);
    Route::apiResource('keynotes', KeynoteController::class);
    Route::apiResource('news', NewsController::class);
    Route::get('/important-dates', [ImportantDateController::class, 'index']);

    // Authentication routes (public)
    // Users cannot self-sign up; accounts are created by admins.
    Route::post('/auth/login', [AuthController::class, 'login']);

    // Protected routes (require authentication)
    Route::middleware('auth:sanctum')->group(function () {
        // Auth routes
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::post('/auth/refresh', [AuthController::class, 'refresh']);
        Route::get('/auth/me', [AuthController::class, 'me']);

        // Self-service registration for authenticated users
        Route::get('/me/register', [RegisterController::class, 'showForCurrentUser']);
        Route::post('/me/register', [RegisterController::class, 'storeForCurrentUser']);
        Route::delete('/me/register', [RegisterController::class, 'destroyForCurrentUser']);

        // Admin-only routes
        Route::middleware(\App\Http\Middleware\EnsureAdmin::class)->group(function () {
            // User management
            Route::apiResource('users', UserController::class);

            // Registration management
            Route::apiResource('register', RegisterController::class);
            Route::get('/users/{userId}/register', [RegisterController::class, 'indexByUser']);

            // Important dates management (admin)
            Route::apiResource('important-dates', ImportantDateController::class)->except(['index']);
        });
    });
});

