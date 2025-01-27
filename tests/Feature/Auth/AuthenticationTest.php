<?php

use App\Models\User;


it('authenticates a user and returns a token', function () {
    $user = User::factory()->create([
        'password' => bcrypt('password'),
    ]);

    $response = $this->postJson('/api/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);
    $response->assertStatus(200)
        ->assertJsonStructure(['data' => ['token']]);
});

it('returns a 401 response if the email does not exist', function () {
    $response = $this->postJson('/api/login', [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);
    $response->assertStatus(401);
});

it('returns a 401 response if the password is incorrect', function () {
    $user = User::factory()->create([
        'password' => bcrypt('password'),
    ]);

    $response = $this->postJson('/api/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);
    $response->assertStatus(401);
});
