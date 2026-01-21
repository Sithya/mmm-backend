<?php

namespace App\Http\Controllers;

use App\Models\Register;
use App\Helpers\ApiResponse;
use App\Http\Requests\CreateRegisterRequest;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    /**
     * Store a new conference registration
     */
    public function store(CreateRegisterRequest $request): JsonResponse
    {
        $registration = Register::create($request->validated());
        return ApiResponse::success($registration, 'registration created successfully', 201);

    }
}
