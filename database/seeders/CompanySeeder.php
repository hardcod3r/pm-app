<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run()
    {
        //5 demo companies 2 from the United States and 3 from the Greece
        Company::factory(2)->country('United States')->create();
        Company::factory(3)->country('Greece')->create();
    }
}
