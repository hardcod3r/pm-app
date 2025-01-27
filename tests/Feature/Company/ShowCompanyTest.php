<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;


//check if company can be viewed

it('should show a company', function () {
    //first create an admin user
    $admin = User::factory()->admin_role()->create();
    $company = \App\Models\Company::factory()->create();
    
    //authenticate the admin user
    Sanctum::actingAs($admin);
    $response = $this->getJson('/api/companies/' . $company->id);

    $response->assertStatus(200)
        ->assertJsonPath('data.name', $company->name)
        ->assertJsonPath('data.vat', $company->vat_id);
    
});

//check if a user can view a company that does not belong to them

it('should not show a company if role is user', function () {
    //first create an admin user
    $user = User::factory()->user_role()->create();
    $company = \App\Models\Company::factory()->create();
    
    //authenticate the admin user
    Sanctum::actingAs($user);
    $response = $this->getJson('/api/companies/' . $company->id);

    $response->assertStatus(403);
    
});


//check if a user can view a company that does belong to them

it('should show a company if role is user', function () {
    //first create an admin user
    $user = User::factory()->user_role()->create();
    $company = \App\Models\Company::factory()->create();
    $user->companies()->attach($company->id);
    //authenticate the admin user
    Sanctum::actingAs($user);
    $response = $this->getJson('/api/companies/' . $company->id);

    $response->assertStatus(200)
        ->assertJsonPath('data.name', $company->name)
        ->assertJsonPath('data.vat', $company->vat_id);
    
});
