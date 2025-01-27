<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Api\Country\GetCountryListAction;

class CountryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, GetCountryListAction $action)
    {
        return $action->run();
    }
}
