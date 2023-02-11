<?php

namespace App\Traits;

trait APIResponse
{
    /**
     * Core of response
     *
     * @param string $message
     * @param array|object $data
     * @param integer $statusCode
     * @param boolean $isSuccess
     */
    private function response($message, $data = null, $statusCode, $isSuccess = true)
    {
        if (!$message) return response()->json(['message' => 'Message is required.'], 500);

        // Send the response
        if ($isSuccess) {
            return response()->json([
                'message' => $message,
                'error' => false,
                'code' => $statusCode,
                'results' => $data
            ], $statusCode);
        } else {
            return response()->json([
                'message' => $message,
                'error' => true,
                'code' => $statusCode,
            ], $statusCode);
        }
    }

    /**
     * Send any success response
     *
     * @param string $message
     * @param array|object $data
     * @param integer $statusCode
     */
    public function successResponse($message, $data, $statusCode = 200)
    {
        return $this->response($message, $data, $statusCode);
    }

    /**
     * Send any error response
     *
     * @param string $message
     * @param integer $statusCode
     */
    public function errorResponse($message, $statusCode = 500)
    {
        return $this->response($message, null, $statusCode, false);
    }
}
