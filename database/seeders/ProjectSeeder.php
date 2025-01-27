<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Company;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        // Assign 3 projects to each company
        Company::all()->each(function ($company) {
            //  3 projects for each company 2 standard and 1 complex
            Project::factory(2)->standard()->create([
                'company_id' => $company->id,
            ]);
            Project::factory()->complex()->create([
                'company_id' => $company->id,
            ]);
        });
    }
}
