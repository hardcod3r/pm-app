<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use App\Abstract\Policies\BasicPolicy;
class CompanyPolicy extends BasicPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // This will return true but data filtered based on the user role in the GetCompanyListAction class
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Company $company): bool
    {
        //user  can only view their company
        return $user->companies->contains($company);
    }
    

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Company $company): bool
    {
        return $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Company $company): bool
    {
        return $this->deny();
    }
}
