<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckIsJson
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->getContent()) {
            return response()->json([
                'message' => 'The request is not a valid JSON.',
            ], 400);
        }

        $result = json_decode($request->getContent());
        if ($result === null) {
            return response()->json([
                'message' => 'The request is not a valid JSON.',
            ], 400);
        }

        return $next($request);
    }
}
