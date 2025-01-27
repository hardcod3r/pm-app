<?php declare (strict_types = 1);

namespace App\Actions\Api\Company;

use App\Http\Collections\CompanyCollection;
use App\Filters\Contracts\CompanyFilter;

class GetCompanyListAction
{

    protected CompanyFilter $filter;

    public function __construct(CompanyFilter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * Execute the action.
     *  
     * @return mixed
     */
    public function run()
    {
        try{
              $companies = $this->filter->getCompanies();
            return new CompanyCollection($companies);
        }catch(\Exception $e){
            return [
                'success' => false,
                'message' => 'Unable to fetch companies',
                'errors' => [$e->getMessage()],
            ];
        }
  
    }
}