<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Testing\Fluent\AssertableJson;
//if a user is not authenticated, they should not be able to view a list of projects

it('should return a list of projects for an admin', function () {
    $admin = User::factory()->admin_role()->create();
    Sanctum::actingAs($admin);
    $response = $this->getJson(route('projects.index'));
    $response->assertStatus(200);
});