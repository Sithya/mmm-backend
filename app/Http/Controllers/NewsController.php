<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Concerns\HandlesApiQueries;
use App\Models\News;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    use HandlesApiQueries;

    /**
     * Get all news items
     */
    public function index(Request $request): JsonResponse
    {
        $query = News::query();
        $query = $this->applyQueryFilters($query, $request, [
            'default_sort' => 'published_at',
            'default_order' => 'desc',
            'filter_by_page_id' => true,
        ]);

        $result = $this->getPaginatedOrAll($query, $request);

        if ($result instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator) {
            return ApiResponse::paginated($result);
        }

        return ApiResponse::success($result);
    }

    /**
     * Get a news item by ID
     */
    public function show(News $news): JsonResponse
    {
        return ApiResponse::success($news);
    }

    /**
     * Create a news item
     */
    public function store(CreateNewsRequest $request): JsonResponse
    {
        $newsItem = News::create($request->validated());
        return ApiResponse::success($newsItem, 'News item created successfully', 201);
    }

    /**
     * Update a news item
     */
    public function update(UpdateNewsRequest $request, News $news): JsonResponse
    {
        $news->update($request->validated());
        return ApiResponse::success($news->fresh(), 'News item updated successfully');
    }

    /**
     * Delete a news item
     */
    public function destroy(News $news): JsonResponse
    {
        $news->delete();
        return ApiResponse::success(null, 'News item deleted successfully', 204);
    }
}
