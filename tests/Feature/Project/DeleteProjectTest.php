<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use App\Models\Project;
//allows  an admin to delete a project

it('allows  an admin to delete a project', function () {
    // Arrange: Create an admin user and authenticate with Sanctum
    $admin = User::factory()->admin_role()->create();
    Sanctum::actingAs($admin); // Grant all abilities to the admin user

    // Act: Make a DELETE request to the /api/projects/{project} endpoint
    $project = Project::factory()->create();
    $response = $this->deleteJson("/api/projects/{$project->id}");

    // Assert: Check that the project was deleted successfully
    $response->assertNoContent();
    $this->assertDatabaseMissing('projects', ['id' => $project->id]);
});

//does not allow a non-admin to delete a project

it('does not allow a non-admin to delete a project', function () {
    // Arrange: Create a regular user and authenticate with Sanctum
    $user = User::factory()->create();
    Sanctum::actingAs($user); // Grant all abilities to the user

    // Act: Make a DELETE request to the /api/projects/{project} endpoint
    $project = Project::factory()->create();
    $response = $this->deleteJson("/api/projects/{$project->id}");

    // Assert: Check that the user is unauthorized to delete the project
    $response->assertStatus(403);
    $this->assertDatabaseHas('projects', ['id' => $project->id]);
});