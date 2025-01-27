<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

//if a user is not authenticated, they should not be able to assign a project to a company

it('should not assign a project to a company if user is not an admin', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);
    $project = \App\Models\Project::factory()->create();
    $company = \App\Models\Company::factory()->create();
    $response = $this->postJson('/api/projects/'.$project->id.'/companies/'.$company->id);
    $response->assertStatus(403);
});

//if a user is admin, they should be able to assign a project to a company

it('should assign a project to a company if user is an admin', function () {
    $admin = User::factory()->admin_role()->create();
    Sanctum::actingAs($admin);
    $project = \App\Models\Project::factory()->create();
    $company = \App\Models\Company::factory()->create();
    $response = $this->postJson('/api/projects/'.$project->id.'/companies/'.$company->id);
    $response->assertStatus(200);
    $response->assertJsonFragment([
        'message' => 'Project assigned to company successfully'
    ]);
});