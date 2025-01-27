<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create 1 demo super admin using the User factory 
        $details = config('project.super_admin');
        User::factory()->admin_role()->create($details);
        // Create 10 demo users using the User factory
        User::factory()->count(10)->user_role()->create();
        // Create 3 demo admins using the User factory
        User::factory()->count(3)->admin_role()->create();
    }
}
