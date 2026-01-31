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
use App\Http\Controllers\FaqController;
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

    // ========================================
    // PUBLIC ROUTES (Read-only for all users)
    // ========================================
    
    // Pages
    Route::get('pages/slug/{slug}', [PageController::class, 'showBySlug']);
    Route::get('pages', [PageController::class, 'index']);
    Route::get('pages/{page}', [PageController::class, 'show']);
    
    // Organizations
    Route::get('organizations', [OrganizationController::class, 'index']);
    Route::get('organizations/{organization}', [OrganizationController::class, 'show']);
    
    // Authors
    Route::get('authors', [AuthorController::class, 'index']);
    Route::get('authors/{author}', [AuthorController::class, 'show']);
    
    // Calls
    Route::get('calls', [CallController::class, 'index']);
    Route::get('calls/{call}', [CallController::class, 'show']);
    
    // Conferences
    Route::get('conferences', [ConferenceController::class, 'index']);
    Route::get('conferences/{conference}', [ConferenceController::class, 'show']);
    
    // Keynotes
    Route::get('keynotes', [KeynoteController::class, 'index']);
    Route::get('keynotes/{keynote}', [KeynoteController::class, 'show']);
    
    // News
    Route::get('news', [NewsController::class, 'index']);
    Route::get('news/{news}', [NewsController::class, 'show']);
    
    // Important Dates
    Route::get('important-dates', [ImportantDateController::class, 'index']);
    Route::get('important-dates/{important_date}', [ImportantDateController::class, 'show']);
    
    // FAQs
    Route::get('faqs', [FaqController::class, 'index']);
    Route::get('faqs/{faq}', [FaqController::class, 'show']);

    // Registrations (public can submit)
    Route::post('/registrations', [RegisterController::class, 'store']);

    // Authentication routes (public)
    Route::post('/auth/login', [AuthController::class, 'login']);

    // ========================================
    // PROTECTED ROUTES (Require authentication)
    // ========================================
    Route::middleware('auth:sanctum')->group(function () {
        // Auth routes
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::post('/auth/refresh', [AuthController::class, 'refresh']);
        Route::get('/auth/me', [AuthController::class, 'me']);

        // ========================================
        // ADMIN-ONLY ROUTES (CRUD operations)
        // ========================================
        Route::middleware(\App\Http\Middleware\EnsureAdmin::class)->group(function () {
            // User management
            Route::apiResource('users', UserController::class);

            // Pages (create, update, delete)
            Route::post('pages', [PageController::class, 'store']);
            Route::put('pages/{page}', [PageController::class, 'update']);
            Route::patch('pages/{page}', [PageController::class, 'update']);
            Route::delete('pages/{page}', [PageController::class, 'destroy']);

            // Organizations (create, update, delete)
            Route::post('organizations', [OrganizationController::class, 'store']);
            Route::put('organizations/{organization}', [OrganizationController::class, 'update']);
            Route::patch('organizations/{organization}', [OrganizationController::class, 'update']);
            Route::delete('organizations/{organization}', [OrganizationController::class, 'destroy']);
            Route::patch('organizations/category', [OrganizationController::class, 'updateCategory']);
            Route::post('organizations/category', [OrganizationController::class, 'deleteCategory']);

            // Authors (create, update, delete)
            Route::post('authors', [AuthorController::class, 'store']);
            Route::put('authors/{author}', [AuthorController::class, 'update']);
            Route::patch('authors/{author}', [AuthorController::class, 'update']);
            Route::delete('authors/{author}', [AuthorController::class, 'destroy']);

            // Calls (create, update, delete)
            Route::post('calls', [CallController::class, 'store']);
            Route::put('calls/{call}', [CallController::class, 'update']);
            Route::patch('calls/{call}', [CallController::class, 'update']);
            Route::delete('calls/{call}', [CallController::class, 'destroy']);

            // Conferences (create, update, delete)
            Route::post('conferences', [ConferenceController::class, 'store']);
            Route::put('conferences/{conference}', [ConferenceController::class, 'update']);
            Route::patch('conferences/{conference}', [ConferenceController::class, 'update']);
            Route::delete('conferences/{conference}', [ConferenceController::class, 'destroy']);

            // Keynotes (create, update, delete)
            Route::post('keynotes', [KeynoteController::class, 'store']);
            Route::put('keynotes/{keynote}', [KeynoteController::class, 'update']);
            Route::patch('keynotes/{keynote}', [KeynoteController::class, 'update']);
            Route::delete('keynotes/{keynote}', [KeynoteController::class, 'destroy']);

            // News (create, update, delete)
            Route::post('news', [NewsController::class, 'store']);
            Route::put('news/{news}', [NewsController::class, 'update']);
            Route::patch('news/{news}', [NewsController::class, 'update']);
            Route::delete('news/{news}', [NewsController::class, 'destroy']);

            // Important Dates (create, update, delete)
            Route::post('important-dates', [ImportantDateController::class, 'store']);
            Route::put('important-dates/{important_date}', [ImportantDateController::class, 'update']);
            Route::patch('important-dates/{important_date}', [ImportantDateController::class, 'update']);
            Route::delete('important-dates/{important_date}', [ImportantDateController::class, 'destroy']);

            // FAQs (create, update, delete)
            Route::post('faqs', [FaqController::class, 'store']);
            Route::put('faqs/{faq}', [FaqController::class, 'update']);
            Route::patch('faqs/{faq}', [FaqController::class, 'update']);
            Route::delete('faqs/{faq}', [FaqController::class, 'destroy']);

            // Registrations (view, delete - admin only)
            Route::get('registrations', [RegisterController::class, 'index']);
            Route::get('registrations/{registration}', [RegisterController::class, 'show']);
            Route::delete('registrations/{registration}', [RegisterController::class, 'destroy']);
        });
    });
});

