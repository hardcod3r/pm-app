<?php declare (strict_types = 1);

namespace App\Filters;

use App\Filters\Contracts\CompanyFilter;
use Illuminate\Support\Facades\Gate;
class UserCompanyFilter implements CompanyFilter
{
    public function getCompanies(): mixed
    {
        
        return auth()->user()->companies; // This will return the companies that the user is associated with
    }
}
