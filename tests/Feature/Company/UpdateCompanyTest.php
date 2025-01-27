<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;


//check if company can be updated by an admin

it('should update a company', function () {
    //first create an admin user
    $admin = User::factory()->admin_role()->create();
    $company = \App\Models\Company::factory()->create();
    
    //authenticate the admin user
    Sanctum::actingAs($admin);
    $details = config('project.tests.companies.create');
    //we need to select country_id from countries table
    $country = \App\Models\Country::factory()->create();
    $details['country_id'] = $country->id;
    //change first part of email to avoid unique constraint dynamic value
    $vat_id = 'US'.fake()->regexify('[0-9]{9}');
    $details['name'] = fake()->name;
    $details['vat_id'] =  $vat_id;
    $response = $this->putJson('/api/companies/' . $company->id, $details);

    $response->assertStatus(200)
        ->assertJsonPath('data.name', $details['name'])
        ->assertJsonPath('data.vat',  $vat_id);
    
});

//check if a user can update any company

it('should not update a company if role is user', function () {
    //first create an admin user
    $user = User::factory()->user_role()->create();
    $company = \App\Models\Company::factory()->create();
    
    //authenticate the admin user
    Sanctum::actingAs($user);
    $details = config('project.tests.companies.create');
    //we need to select country_id from countries table
    $country = \App\Models\Country::factory()->create();
    $details['country_id'] = $country->id;
    //change first part of email to avoid unique constraint dynamic value
    $vat_id = 'US'.fake()->regexify('[0-9]{9}');
    $details['name'] = fake()->name;
    $details['vat_id'] =  $vat_id;
    $response = $this->putJson('/api/companies/' . $company->id, $details);

    $response->assertStatus(403);
    
});

