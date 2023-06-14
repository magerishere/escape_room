<?php

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use \Illuminate\Http\Request;


if (!function_exists('apiResponseData')) {
    /**
     * set response as 'data' key
     * @param mixed $data
     * @return JsonResponse
     */
    function apiResponseData(mixed $data, int $status = 200): JsonResponse
    {
        return response()->json([
            'data' => $data
        ], $status);
    }
}

if (!function_exists('apiResponseMessage')) {
    /**
     * set response as 'message' key
     * @param string|array $message
     * @param int $status
     * @return JsonResponse
     */
    function apiResponseMessage(string|array $message, int $status = 200): JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], $status);
    }
}

if (!function_exists('isApiRequest')) {
    /**
     * check if request is api
     * @param Request $request
     * @return bool
     */
    function isApiRequest(Request $request): bool
    {
        return $request->is('api/*');
    }
}

if (!function_exists('isSameDayAtMonth')) {
    /**
     * Check if two date at same day at month with or without same year
     * @param Carbon $target
     * @param Carbon $haystack
     * @param bool $ofSameYear
     * @return bool
     */
    function isSameDayAtMonth(Carbon $target, Carbon $haystack, bool $ofSameYear = true): bool
    {
        return $target->day === $haystack->day && $target->isSameMonth($haystack, $ofSameYear);
    }
}
