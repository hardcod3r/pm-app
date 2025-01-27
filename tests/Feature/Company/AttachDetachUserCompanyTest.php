<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

//check if admin can attach or detach a user to/from a company

it('should attach or detatch a user to/from a company', function () {
    //first create an admin user
    $admin = User::factory()->admin_role()->create();
    $company = \App\Models\Company::factory()->create();
    $user = User::factory()->create();
    
    //authenticate the admin user
    Sanctum::actingAs($admin);
    $response = $this->postJson('/api/companies/'.$company->id.'/users/'.$user->id);
    
    $response->assertStatus(200)
        ->assertJsonPath('data.action', 'attach');

    //we use same endpoint for detaching a user from a company
    $response = $this->postJson('/api/companies/'.$company->id.'/users/'.$user->id);

    $response->assertStatus(200)
        ->assertJsonPath('data.action', 'detach');    
});

//check if a user can attach or detach a user to/from a company

it('should not attach or detatch a user to/from a company if role is user', function () {
    //first create an admin user
    $user = User::factory()->user_role()->create();
    $company = \App\Models\Company::factory()->create();
    $user_to_attach = User::factory()->create();
    
    //authenticate the admin user
    Sanctum::actingAs($user);
    $response = $this->postJson('/api/companies/'.$company->id.'/users/'.$user_to_attach->id);
    
    $response->assertStatus(403);
    
    //we use same endpoint for detaching a user from a company
    $response = $this->postJson('/api/companies/'.$company->id.'/users/'.$user_to_attach->id);

    $response->assertStatus(403);    
});

