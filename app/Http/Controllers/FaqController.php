<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use App\Helpers\ApiResponse;
use App\Models\Faq;
use Illuminate\Http\JsonResponse;

class FaqController extends Controller
{
    /**
     * Get all FAQs
     */
    public function index(): JsonResponse
    {
        $perPage = request('per_page', 15);
        $sort = request('sort', 'order');
        $order = request('order', 'asc');

        $faqs = Faq::orderBy($sort, $order)
            ->paginate(min($perPage, 100));

        return ApiResponse::paginated($faqs);
    }

    /**
     * Get a single FAQ
     */
    public function show($id): JsonResponse
    {
        $faq = Faq::findOrFail($id);

        return ApiResponse::success($faq);
    }

    /**
     * Create a new FAQ
     */
    public function store(CreateFaqRequest $request): JsonResponse
    {
        $faq = Faq::create($request->validated());

        return ApiResponse::success(
            $faq,
            'FAQ created successfully',
            201
        );
    }

    /**
     * Update an FAQ
     */
    public function update(UpdateFaqRequest $request, $id): JsonResponse
    {
        $faq = Faq::findOrFail($id);
        $faq->update($request->validated());

        return ApiResponse::success(
            $faq->fresh(),
            'FAQ updated successfully'
        );
    }

    /**
     * Delete an FAQ
     */
    public function destroy($id): JsonResponse
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return ApiResponse::success(
            null,
            'FAQ deleted successfully',
            204
        );
    }
}
