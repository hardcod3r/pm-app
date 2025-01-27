<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use App\Enums\ProjectType;
use App\Enums\ProjectPhase;
use Carbon\Carbon;
//allows  an admin to create a project

it('allows  an admin to create a simple project', function () {
    // Arrange: Create an admin user and authenticate with Sanctum
    $admin = User::factory()->admin_role()->create();
    Sanctum::actingAs($admin); // Grant all abilities to the admin user

    // Act: Make a POST request to the /api/projects endpoint
    $name = fake()->name;
    $description = fake()->sentence;
    $response = $this->postJson('/api/projects', [
        'name' =>  $name,
        'description' => $description,
        'project_type' => ProjectType::Standard,
        'phase' => ProjectPhase::Planning,
    ]);

    // Assert: Check that the project was created successfully
    $response->assertCreated();
    $response->assertJsonFragment([
        'name' => $name,
        'description' => $description,
    ]);
});

it('allows  an admin to create a complex project', function () {
    // Arrange: Create an admin user and authenticate with Sanctum
    $admin = User::factory()->admin_role()->create();
    Sanctum::actingAs($admin); // Grant all abilities to the admin user

    $name = fake()->name;
    $description = fake()->sentence;
    // Act: Make a POST request to the /api/projects endpoint
    $response = $this->postJson('/api/projects', [
        'name' => $name,
        'description' => $description,
        'project_type' => ProjectType::Complex,
        'phase' => ProjectPhase::Planning,
        'budget' => '1000.50',
        'timeline' => [
            'start_date' => Carbon::now()->format('Y-m-d'),
            'end_date' => Carbon::now()->addDays(30)->format('Y-m-d'),
        ],
    ]);

    // Assert: Check that the project was created successfully
    $response->assertCreated();
    $response->assertJsonFragment([
        'name' => $name,
        'description' => $description,
    ]);
});