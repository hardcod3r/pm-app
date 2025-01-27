<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;


it('should delete a user', function () {
    //first create an admin user
    $admin = User::factory()->admin_role()->create();
    $user = User::factory()->user_role()->create();
    
    //authenticate the admin user
    Sanctum::actingAs($admin);
    $response = $this->deleteJson('/api/users/' . $user->id);

    $response->assertStatus(204);

    //assert that the user has been deleted

    $this->assertDatabaseMissing('users', ['id' => $user->id]);
    
});
