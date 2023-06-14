<?php

use Illuminate\Http\JsonResponse;
use \Illuminate\Http\Request;


if (!function_exists('apiResponseData')) {
    function apiResponseData(mixed $data): JsonResponse
    {
        return response()->json([
            'data' => $data
        ]);
    }
}

if (!function_exists('apiResponseMessage')) {
    function apiResponseMessage(string $message): JsonResponse
    {
        return response()->json([
            'message' => $message,
        ]);
    }
}

if (!function_exists('isApiRequest')) {
    function isApiRequest(Request $request): bool
    {
        return $request->is('api/*');
    }
}
