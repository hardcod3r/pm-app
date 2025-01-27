<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

//if a user is not authenticated, they should not be able to view a list of companies

it('should return a list of companies', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);
    $response = $this->getJson(route('companies.index'));
    $response->assertStatus(200);
});
