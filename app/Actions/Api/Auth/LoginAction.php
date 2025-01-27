<?php

declare(strict_types=1);

namespace App\Actions\Api\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class LoginAction
{
    /**
     * Execute the action.
     *
     * @param array $data
     * @return mixed
     */
    public function run(array $data)
    {
        if (!Auth::attempt($data)) {
            return [
                'message' => 'Invalid credentials',
                'errors' => [],
            ];
        }

        $user = Auth::user();
        // Create a token for the authenticated user
        try {
            $user->tokens()->delete();
            $token = $user->createToken('API Token')->plainTextToken;
            return [
                'user' => new UserResource($user),
                'token' => $token,
            ];
        } catch (\Exception $e) {
            return [
                'message' => 'Unable to create token',
                'errors' => [$e->getMessage()],
            ];
        }
    }
}
