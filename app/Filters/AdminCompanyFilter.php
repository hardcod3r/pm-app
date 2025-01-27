<?php declare (strict_types = 1);

namespace App\Filters;

use App\Models\Company;
use App\Filters\Contracts\CompanyFilter;
class AdminCompanyFilter implements CompanyFilter
{
    public function getCompanies() : mixed
    {
        return Company::paginate();
    }
}
