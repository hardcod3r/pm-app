<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('allows  an admin to create a company', function () {
    // Arrange: Create an admin user and authenticate with Sanctum
    $admin = User::factory()->admin_role()->create();
    Sanctum::actingAs($admin); // Grant all abilities to the admin user
    $details = config('project.tests.companies.create');
    //we need to select country_id from countries table
    $country = \App\Models\Country::factory()->create();
    $details['country_id'] = $country->id;
    //change first part of email to avoid unique constraint dynamic value
    $vat_id = 'US'.fake()->regexify('[0-9]{9}');
    $details['name'] = fake()->name;
    $details['vat_id'] =  $vat_id;
    // Act: Send a POST request to create a new user
    $response = $this->postJson('/api/companies', $details);
    // Assert: Check the response and database
    $response->assertStatus(201) // Ensure the response status is 201 (Created)
        ->assertJsonPath('data.name', $details['name']) // Check the response contains the new user's data
        ->assertJsonPath('data.vat',  $vat_id);

    $this->assertDatabaseHas('companies', [
        'name' => $details['name'],
        'vat_id' => $vat_id,
    ]);
});


//check if a user can create a company  

it('does not allow a non-admin to create a company', function () {
    // Arrange: Create a regular user and authenticate with Sanctum
    $user = User::factory()->user_role()->create();
    Sanctum::actingAs($user); // Grant all abilities to the regular user
    $details = config('project.tests.companies.create');
    //we need to select country_id from countries table
    $country = \App\Models\Country::factory()->create();
    $details['country_id'] = $country->id;
    //change first part of email to avoid unique constraint dynamic value
    $vat_id = 'US'.fake()->regexify('[0-9]{9}');
    $details['name'] = fake()->name;
    $details['vat_id'] =  $vat_id;
    // Act: Send a POST request to create a new user
    $response = $this->postJson('/api/companies', $details);

    // Assert: Check the response and database
    $response->assertStatus(403); // Ensure the response status is 403 (Forbidden)
});
