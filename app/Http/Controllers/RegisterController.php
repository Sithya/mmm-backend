<?php

namespace App\Http\Controllers;

use App\Models\Register;
use App\Helpers\ApiResponse;
use App\Http\Requests\CreateRegisterRequest;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    /**
     * Get all registrations (Admin only)
     */
    public function index(): JsonResponse
    {
        $perPage = request('per_page', 15);
        $sort = request('sort', 'created_at');
        $order = request('order', 'desc');

        $registrations = Register::orderBy($sort, $order)
            ->paginate(min($perPage, 100));

        return ApiResponse::paginated($registrations);
    }

    /**
     * Get a single registration (Admin only)
     */
    public function show($id): JsonResponse
    {
        $registration = Register::findOrFail($id);
        return ApiResponse::success($registration);
    }

    /**
     * Store a new conference registration (Public)
     */
    public function store(CreateRegisterRequest $request): JsonResponse
    {
        $registration = Register::create($request->validated());
        return ApiResponse::success($registration, 'registration created successfully', 201);
    }

    /**
     * Delete a registration (Admin only)
     */
    public function destroy($id): JsonResponse
    {
        $registration = Register::findOrFail($id);
        $registration->delete();
        return ApiResponse::success(null, 'Registration deleted successfully', 204);
    }
}
