<?php declare(strict_types=1);

namespace App\Abstract\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
abstract class ApiController extends Controller
{
    /**
     * Success response helper.
     *
     * @param mixed $data
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    protected function successResponse($data = [], string $message = 'Success', int $status = 200): JsonResponse
    {
        return response()->json([
            'data' => $data,
        ], $status);
    }

    /**
     * Error response helper.
     *
     * @param string $message
     * @param int $status
     * @param array $errors
     * @return JsonResponse
     */
    protected function errorResponse(string $message, int $status = 400, array $errors = []): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }

    /**
     * Validation error response helper.
     *
     * @param array $errors
     * @return JsonResponse
     */
    protected function validationErrorResponse(array $errors): JsonResponse
    {
        return $this->errorResponse('Validation error', 422, $errors);
    }

    /**
     * Not found response helper.
     *
     * @param string $message
     * @return JsonResponse
     */

    protected function notFoundResponse(string $message = 'Resource not found'): JsonResponse
    {
        return $this->errorResponse($message, 404);
    }

    /**
     * Unauthorized response helper.
     *
     * @param string $message
     * @return JsonResponse
     */

    protected function unauthorizedResponse(string $message = 'Unauthorized'): JsonResponse
    {
        return $this->errorResponse($message, 401);
    }

    /**
     * Forbidden response helper.
     *
     * @param string $message
     * @return JsonResponse
     */

    protected function forbiddenResponse(string $message = 'Forbidden'): JsonResponse
    {
        return $this->errorResponse($message, 403);
    }

    /**
     * Internal server error response helper.
     *
     * @param string $message
     * @return JsonResponse
     */

    protected function internalServerErrorResponse(string $message = 'Internal server error'): JsonResponse
    {
        return $this->errorResponse($message, 500);
    }


    /**
     * Bad request response helper.
     *
     * @param string $message
     * @return JsonResponse
     */

    protected function badRequestResponse(string $message = 'Bad request'): JsonResponse
    {
        return $this->errorResponse($message, 400);
    }

    /**
     * Method not allowed response helper.
     *
     * @param string $message
     * @return JsonResponse
     */

    protected function methodNotAllowedResponse(string $message = 'Method not allowed'): JsonResponse
    {
        return $this->errorResponse($message, 405);
    }
    
}
