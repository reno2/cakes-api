<?php

namespace App\Traits;

trait ApiResponseTrait
{

    protected function successResponse($data, $message = null, $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            [
                'status' => 'Success',
                'message' => $message,
                'data' => $data
            ],
            $code
        );
    }

    protected function errorResponse($message = null, $code): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            [
                'status' => 'Error',
                'message' => $message,
                'data' => null
            ],
            $code
        );
    }
}
