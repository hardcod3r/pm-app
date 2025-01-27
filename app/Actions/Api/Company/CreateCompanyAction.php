<?php

declare(strict_types=1);

namespace App\Actions\Api\Company;


use App\Http\Resources\CompanyResource;
use App\Models\Company;

class CreateCompanyAction
{
    /**
     * Execute the action.
     *  
     * @param array $data
     * @return mixed
     */
    public function run(array $data): mixed
    {
        try {
            $company = Company::create($data);
            return new CompanyResource($company);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
