<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use App\Models\Project;

//check if project can be updated by an admin

it('admin can update project', function () {
    $user = User::factory()->admin_role()->create();
    Sanctum::actingAs($user);
    $project = Project::factory()->create();
    $response = $this->putJson(route('projects.update', $project->id), [
        'name' => 'New Project Name',
        'description' => 'New Project Description',
    ]);
    $response->assertStatus(200);
    $response->assertJsonFragment([
        'name' => 'New Project Name',
        'description' => 'New Project Description'
    ]);
});

//check if project can be updated by a standard user

it('standard user can not update project', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);
    $project = Project::factory()->create();
    $response = $this->putJson(route('projects.update', $project->id), [
        'name' => 'New Project Name',
        'description' => 'New Project Description',
    ]);
    $response->assertStatus(403);
});
