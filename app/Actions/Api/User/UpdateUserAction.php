<?php declare(strict_types=1);

namespace App\Actions\Api\User;

use App\Models\User;
use App\Http\Resources\UserResource;
class UpdateUserAction
{
    public function run(array $data, string $id): UserResource
    {
        try {
            $user = User::findOrFail($id);
            $user->update($data);
            return new UserResource($user);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}