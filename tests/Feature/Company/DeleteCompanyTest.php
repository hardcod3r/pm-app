<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;


it('should delete a company', function () {
    //first create an admin user
    $admin = User::factory()->admin_role()->create();
    $company = \App\Models\Company::factory()->create();
    
    //authenticate the admin user
    Sanctum::actingAs($admin);
    $response = $this->deleteJson('/api/companies/' . $company->id);

    $response->assertStatus(204);

    //assert that the company has been deleted

    $this->assertDatabaseMissing('companies', ['id' => $company->id]);
    
});

it('should not delete a company if role is user', function () {
    //first create an admin user
    $user = User::factory()->user_role()->create();
    $company = \App\Models\Company::factory()->create();
    
    //authenticate the admin user
    Sanctum::actingAs($user);
    $response = $this->deleteJson('/api/companies/' . $company->id);

    $response->assertStatus(403);

    //assert that the company has been deleted

    $this->assertDatabaseHas('companies', ['id' => $company->id]);
    
});