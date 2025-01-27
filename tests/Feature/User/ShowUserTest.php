<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('should show user', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $response = $this->getJson(route('users.show', $user->id));

    $response->assertOk();
    $response->assertJsonStructure([
        'data' => [
            'id',
            'first_name',
            'last_name',
            'email',
            'role',
        ],
    ]);
});

it('should not show user if not authenticated', function () {
    $user = User::factory()->create();

    $response = $this->getJson(route('users.show', $user->id));

    $response->assertUnauthorized();
});

