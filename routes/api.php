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

    // Add your API routes here
    // Example:
    // Route::apiResource('users', UserController::class);
    Route::apiResource('pages', PageController::class);
    Route::apiResource('organizations', OrganizationController::class);
    Route::apiResource('authors', AuthorController::class);
    Route::apiResource('calls', CallController::class);
    Route::apiResource('conferences', ConferenceController::class);
    Route::apiResource('keynotes', KeynoteController::class);
    Route::apiResource('news', NewsController::class);
});

