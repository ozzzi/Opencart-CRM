<?php

declare(strict_types=1);

namespace App\Support\Traits;

use Illuminate\Http\JsonResponse;

trait JsonResponser
{
    protected function success($data = [], string $message = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    protected function error(string $message, int $code, $data = null): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}
