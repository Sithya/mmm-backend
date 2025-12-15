<?php

namespace App\Http\Middleware;

use App\Helpers\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || !$user->is_admin) {
            return ApiResponse::error(
                'AUTHORIZATION_FAILED',
                'You are not authorized to perform this action.',
                null,
                403
            );
        }

        return $next($request);
    }
}


