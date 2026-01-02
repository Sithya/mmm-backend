<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Concerns\HandlesApiQueries;
use App\Models\Faq;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    use HandlesApiQueries;

    /**
     * Get all FAQs
     */
    public function index(Request $request): JsonResponse
    {
        $query = Faq::query();
        $query = $this->applyQueryFilters($query, $request, [
            'default_sort' => 'order',
            'default_order' => 'asc',
            'filter_by_page_id' => false, // FAQs don't have page_id
        ]);

        $result = $this->getPaginatedOrAll($query, $request);

        if ($result instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator) {
            return ApiResponse::paginated($result);
        }

        return ApiResponse::success($result);
    }

    /**
     * Get a single FAQ
     */
    public function show(Faq $faq): JsonResponse
    {
        return ApiResponse::success($faq);
    }

    /**
     * Create a new FAQ
     */
    public function store(CreateFaqRequest $request): JsonResponse
    {
        $faq = Faq::create($request->validated());
        return ApiResponse::success($faq, 'FAQ created successfully', 201);
    }

    /**
     * Update an FAQ
     */
    public function update(UpdateFaqRequest $request, Faq $faq): JsonResponse
    {
        $faq->update($request->validated());
        return ApiResponse::success($faq->fresh(), 'FAQ updated successfully');
    }

    /**
     * Delete an FAQ
     */
    public function destroy(Faq $faq): JsonResponse
    {
        $faq->delete();
        return ApiResponse::success(null, 'FAQ deleted successfully', 204);
    }
}
