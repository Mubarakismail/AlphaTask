<?php

namespace App\Traits;

/**
 * Api Responser
 */
trait ApiResponser
{
    public function sendResponse($data, $message, $code = 200)
    {
        return response()->json([
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ], $code);
    }
    public function sendError($message, $code = 404)
    {
        return response()->json([
            'success' => false,
            'data' => null,
            'message' => $message,
        ], $code);
    }
}
