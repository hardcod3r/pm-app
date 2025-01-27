<?php declare(strict_types=1);

namespace App\Actions\Api\Company;

use App\Models\Company;
use App\Http\Resources\CompanyResource;
class UpdateCompanyAction
{
    public function run(array $data, string $id): CompanyResource
    {
        try {
            $company = Company::findOrFail($id);
            $company->update($data);
            return new CompanyResource($company);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}