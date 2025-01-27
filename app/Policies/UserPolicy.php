<?php

namespace App\Policies;

use App\Models\User;
use App\Abstract\Policies\BasicPolicy;


class UserPolicy extends BasicPolicy
{
   
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $this->deny();   
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model)
    {
        //only the user can view their own profile
        return $user->id === $model->id
            ? true
            : $this->deny();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model)
    {
        return  $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return  $this->deny();
    }
   
}
