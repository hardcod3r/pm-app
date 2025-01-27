<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;
use App\Enums\Role;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CompanySeeder::class,
            ProjectSeeder::class,
        ]);

        // Assign users to companies
        $this->assignUsersToCompanies();
    }

    private function assignUsersToCompanies()
    {
        // Randomly assign users to companies
        $users = User::where('role', Role::User)->get();
        Company::all()->each(function ($company) use ($users) {
            $company->users()->attach(
                $users->random(rand(1, 5))->pluck('id')->toArray(),  ['created_at' => now(), 'updated_at' => now()]
            );
        });
    }
}
