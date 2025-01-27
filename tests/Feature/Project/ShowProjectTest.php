<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use App\Models\Project;

//admin can see project
it('admin can see project', function () {
    $user = User::factory()->admin_role()->create();
    Sanctum::actingAs($user);
    $project = Project::factory()->create();
    $response = $this->getJson(route('projects.show', $project->id));
    $response->assertStatus(200);
});

//standard user can not see any project

it('standard user can not see any project', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);
    $project = Project::factory()->create();
    $response = $this->getJson(route('projects.show', $project->id));
    $response->assertStatus(403);
});
