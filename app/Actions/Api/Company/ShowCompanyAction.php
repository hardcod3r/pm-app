<?php

declare(strict_types=1);

namespace App\Actions\Api\Company;

use App\Models\Company;
use App\Http\Resources\CompanyResource;

class ShowCompanyAction
{
    public function run(Company $company, string $include): CompanyResource
    {
        $relationships = array_filter(explode(',', $include));
        $allowedRelationships = config('project.allowed_relationships.company');
        $validatedRelationships = array_filter($relationships, function ($relationship) use ($allowedRelationships) {
            return in_array($relationship, $allowedRelationships);
        });
        try {
            $company = $company->load($validatedRelationships);
            return new CompanyResource($company);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
