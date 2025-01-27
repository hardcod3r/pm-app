<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Abstract\Controllers\ApiController;
use App\Actions\Api\Auth\LoginAction;


class AuthController extends ApiController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request, LoginAction $action)
    {
        $data = $request->validated();
        $result = $action->run($data);
        if (isset($result['errors'])) {
            return $this->errorResponse($result['message'], 401, $result['errors']);
        }
        return $this->successResponse($result);       
    }
}
