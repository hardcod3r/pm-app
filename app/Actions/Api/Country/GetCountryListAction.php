<?php declare (strict_types = 1);   

namespace App\Actions\Api\Country;  

use App\Http\Collections\CountryCollection;
use App\Models\Country;

class GetCountryListAction
{
    /**
     * Execute the action.
     *  
     * @return mixed
     */
    public function run()
    {
        try{
            $countries = Country::orderBy('name')->get();
            return new CountryCollection($countries);
        }catch(\Exception $e){
            return [
                'success' => false,
                'message' => 'Unable to fetch countries',
                'errors' => [$e->getMessage()],
            ];
        }
  
    }
}