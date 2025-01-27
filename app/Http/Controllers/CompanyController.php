<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Actions\Api\Company\GetCompanyListAction;
use Illuminate\Support\Facades\Gate;
use App\Actions\Api\Company\UpdateCompanyAction;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Http\Requests\Company\StoreCompanyRequest;
use App\Http\Requests\Company\ViewCompanyRequest;
use App\Http\Requests\Company\DestroyCompanyRequest;
use App\Http\Requests\Company\AttachUserToCompanyRequest;
use App\Abstract\Controllers\ResourceController;
use App\Actions\Api\Company\CreateCompanyAction;
use App\Actions\Api\Company\ShowCompanyAction;
use App\Actions\Api\Company\AttachUserAction;
use App\Models\User;


class CompanyController extends ResourceController
{

    public function __construct(
        private readonly GetCompanyListAction $companyAction,
        private readonly UpdateCompanyAction $updateCompanyAction,
        private readonly CreateCompanyAction $createCompanyAction,
        private readonly ShowCompanyAction $showCompanyAction,
        private readonly AttachUserAction $attachUserAction
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  $this->companyAction->run();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $action = $this->createCompanyAction->run($request->validated());
        return $this->success($action, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company, ViewCompanyRequest $request)
    {
        return $this->showCompanyAction->run($company, $request->query('include', ''));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $action =  $this->updateCompanyAction->run($request->validated(), $company->id);
        return $this->success($action);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company, DestroyCompanyRequest $request)
    {
       
        try {   
            //we proceed to delete the company
            if ($company->delete()) {
                return $this->success('', 204);
            }
            return response()->json(['success' => false, 'message' => 'Company could not be deleted'], 500);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    //Attach the user to the company

    public function attachUser(AttachUserToCompanyRequest $request, Company $company, User $user)
    {
        $action = $this->attachUserAction->run($company, $user);
        return $this->success($action);
    }
}
