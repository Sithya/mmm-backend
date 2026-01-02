<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait HandlesApiQueries
{
    /**
     * Apply common query filters and pagination
     */
    protected function applyQueryFilters(Builder $query, Request $request, array $options = []): Builder
    {
        // Default options
        $defaultSort = $options['default_sort'] ?? 'created_at';
        $defaultOrder = $options['default_order'] ?? 'desc';
        $filterByPageId = $options['filter_by_page_id'] ?? true;

        // Filter by page_id if provided
        if ($filterByPageId && $request->has('page_id')) {
            $query->where('page_id', $request->input('page_id'));
        }

        // Apply sorting
        $sort = $request->input('sort', $defaultSort);
        $order = $request->input('order', $defaultOrder);
        $query->orderBy($sort, $order);

        return $query;
    }

    /**
     * Get paginated or all results based on per_page parameter
     */
    protected function getPaginatedOrAll(Builder $query, Request $request, int $maxPerPage = 100)
    {
        $perPage = $request->input('per_page');

        // If per_page is not specified, return all items
        if ($perPage === null) {
            return $query->get();
        }

        // Otherwise, return paginated response
        return $query->paginate(min((int)$perPage, $maxPerPage));
    }
}

