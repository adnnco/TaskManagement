<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

/**
 * Class ApiResponseService
 *
 * This service handles API responses and error handling.
 */
class ApiResponseService
{
    /**
     * Rollback the transaction and throw an exception.
     *
     * @param Exception $e The exception that was caught.
     * @param string $message The message to return in the response.
     * @return void
     *
     * @throws HttpResponseException
     */
    public static function rollback(Exception $e, string $message = 'Something went wrong! Process not completed'): void
    {
        self::logAndThrow($e, $message);
    }

    /**
     * Log the exception and throw an HTTP response exception.
     *
     * @param Exception $e The exception that was caught.
     * @param string $message The message to return in the response.
     *
     * @throws HttpResponseException
     */
    private static function logAndThrow(Exception $e, string $message): void
    {
        Log::error($message . ' : ' . $e->getMessage());
        throw new HttpResponseException(response()->json(['message' => $message], 500));
    }

    /**
     * Log the exception and throw an HTTP response exception.
     *
     * @param Exception $e The exception that was caught.
     * @param string $message The message to return in the response.
     *
     * @throws HttpResponseException
     */
    public static function throw(Exception $e, string $message = 'Something went wrong! Process not completed'): void
    {
        self::logAndThrow($e, $message);
    }

    /**
     * Send a JSON response.
     *
     * @param mixed $result The data to include in the response.
     * @param string $message The message to include in the response.
     * @param int $code The HTTP status code for the response.
     * @return JsonResponse
     */
    public static function sendResponse(mixed $result, string $message = '', int $code = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'data' => $result,
        ];

        if (!empty($message)) {
            $response['message'] = $message;
        }

        return response()->json($response, $code);
    }
}
