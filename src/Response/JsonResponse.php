<?php declare(strict_types=1);

namespace App\Response;

use Symfony\Component\HttpFoundation\JsonResponse as BaseJsonResponse;

/**
 * Custom JSON response class that provides a standardized response format.
 * 
 * This class extends Symfony's JsonResponse to provide consistent
 * response structure across the application.
 */
class JsonResponse extends BaseJsonResponse
{
    /**
     * Creates a success response with data.
     *
     * @param mixed $data The response data
     * @param int $status The HTTP status code
     * @return self
     */
    public static function success(mixed $data, int $status = self::HTTP_OK): self
    {
        return new self([
            'status' => 'success',
            'data' => $data
        ], $status);
    }

    /**
     * Creates an error response with a message.
     *
     * @param string $message The error message
     * @param int $status The HTTP status code
     * @return self
     */
    public static function error(string $message, int $status = self::HTTP_INTERNAL_SERVER_ERROR): self
    {
        return new self([
            'status' => 'error',
            'message' => $message
        ], $status);
    }
} 