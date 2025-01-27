<?php

declare(strict_types=1);

namespace App\Actions\Api\User;

use App\Models\User;
use App\Http\Resources\UserResource;

class ShowUserAction
{
    public function run(string $id, string $include): UserResource
    {
        $relationships = array_filter(explode(',', $include));
        $allowedRelationships = config('project.allowed_relationships.user');
        $validatedRelationships = array_filter($relationships, function ($relationship) use ($allowedRelationships) {
            return in_array($relationship, $allowedRelationships);
        });
        try {
            $user = User::with($validatedRelationships)->findOrFail($id);
            return new UserResource($user);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
