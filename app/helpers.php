<?php

use Illuminate\Http\JsonResponse;
use \Illuminate\Http\Request;


if (!function_exists('apiResponseData')) {
    /**
     * set response as 'data' key
     * @param mixed $data
     * @return JsonResponse
     */
    function apiResponseData(mixed $data): JsonResponse
    {
        return response()->json([
            'data' => $data
        ]);
    }
}

if (!function_exists('apiResponseMessage')) {
    /**
     * set response as 'message' key
     * @param string $message
     * @return JsonResponse
     */
    function apiResponseMessage(string $message): JsonResponse
    {
        return response()->json([
            'message' => $message,
        ]);
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
