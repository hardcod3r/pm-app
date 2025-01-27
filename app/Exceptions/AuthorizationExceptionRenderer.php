<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpFoundation\Response;

class AuthorizationExceptionRenderer
{
    /**
     * Handle the exception.
     *
     * @param  AuthorizationException  $exception
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function __invoke(AuthorizationException $exception, $request): Response
    {
        return response()->json([
            'message' => $exception->getMessage() ?: 'Unauthorized access.',
        ], 403);
    }
}
