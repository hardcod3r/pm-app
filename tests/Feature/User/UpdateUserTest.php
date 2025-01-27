<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('allows an admin to update a user', function () {
    // Arrange: Get an admin user and authenticate with Sanctum
    $admin = User::factory()->admin_role()->create();
    $user = User::factory()->user_role()->create();
    Sanctum::actingAs($admin); // Grant all abilities to the admin user
    $userId = $user->id;
    // Act: Send a PUT request to update a user
    $details = config('project.tests.users.update');
    //change first part of email to avoid unique constraint dynamic value
    $details['email'] = str()->random(7). $details['email'];
    $response = $this->putJson('/api/users/'.$userId, $details);
    // Assert: Check the response and database
    $response->assertStatus(200) // Ensure the response status is 200 (OK)
             ->assertJsonPath('data.first_name', $details['name']) // Check the response contains the updated user's data
             ->assertJsonPath('data.email', $details['email']);
    $this->assertDatabaseHas('users', [
        'email' => $details['email'],
        'name' => $details['name'],
    ]);

});

it('does not allow a non-admin to update a user', function () {
    // Arrange: Create a regular user and authenticate with Sanctum
    $user = User::factory()->user_role()->create();
    $userToUpdate = User::factory()->user_role()->create();
    Sanctum::actingAs($user); // Grant all abilities to the regular user
    $userId = $userToUpdate->id;
    $details = config('project.tests.users.update');
    //change first part of email to avoid unique constraint dynamic value
    $details['email'] = str()->random(7). $details['email'];
    $response = $this->putJson('/api/users/'.$userId, $details);
    // Act: Send a PUT request to update a user
    $response = $this->putJson('/api/users/'.$userId, $details);
    // Assert: Check the response and database
    $response->assertStatus(403); // Ensure the response status is 403 (Forbidden)
});


//validate the request data

it('validates the request data', function () {
    // Arrange: Create an admin user and authenticate with Sanctum
    $admin = User::factory()->admin_role()->create();
    Sanctum::actingAs($admin); // Grant all abilities to the admin user
    $user = User::factory()->user_role()->create();
    $userId = $user->id;
    $details = config('project.tests.users.update');
    //change first part of email to avoid unique constraint dynamic value
    $details['email'] = str()->random(7). $details['email'];
    // Act: Send a PUT request to update a user with invalid data
    $details['email'] = 'invalid-email';
    $response = $this->putJson('/api/users/'.$userId, $details);
    // Assert: Check the response and database
    $response->assertStatus(422) // Ensure the response status is 422 (Unprocessable Entity)
             ->assertJsonValidationErrors(['email']); // Check the response contains the email validation error
});
