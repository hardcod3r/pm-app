<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('allows an admin to create a user', function () {
    // Arrange: Create an admin user and authenticate with Sanctum
    $admin = User::factory()->admin_role()->create();

    Sanctum::actingAs($admin); // Grant all abilities to the admin user
    $details = config('project.tests.users.create');
    //change first part of email to avoid unique constraint dynamic value
    $details['email'] = str()->random(7) . $details['email'];
    // Act: Send a POST request to create a new user
    $response = $this->postJson('/api/users', $details);
    // Assert: Check the response and database
    $response->assertStatus(201) // Ensure the response status is 201 (Created)
        ->assertJsonPath('data.first_name', $details['name']) // Check the response contains the new user's data
        ->assertJsonPath('data.email', $details['email']);

    $this->assertDatabaseHas('users', [
        'email' => $details['email'],
        'name' => $details['name'],
    ]);
});


it('does not allow a non-admin to create a user', function () {
    // Arrange: Create a regular user and authenticate with Sanctum
    $user = User::factory()->user_role()->create();

    Sanctum::actingAs($user); // Grant all abilities to the regular user
    $details = config('project.tests.users.create');
    //change first part of email to avoid unique constraint dynamic value
    $details['email'] = str()->random(7) . $details['email'];
    // Act: Send a POST request to create a new user
    // Act: Send a POST request to create a new user
    $response = $this->postJson('/api/users', $details);

    // Assert: Check the response and database
    $response->assertStatus(403); // Ensure the response status is 403 (Forbidden)
});

//validate the request data

it('validates the request data', function () {
    // Arrange: Create an admin user and authenticate with Sanctum
    $admin = User::factory()->admin_role()->create();
    Sanctum::actingAs($admin); // Grant all abilities to the admin user
    $details = config('project.tests.users.create');
    //change first part of email to avoid unique constraint dynamic value
    $details['email'] = str()->random(7) . $details['email'];
    // Act: Send a POST request to create a new user with invalid data
    $details['email'] = 'invalid-email';
    $response = $this->postJson('/api/users', $details);
    // Assert: Check the response and database
    $response->assertStatus(422) // Ensure the response status is 422 (Unprocessable Entity)
        ->assertJsonValidationErrors(['email']); // Check the response contains the email validation error
});
