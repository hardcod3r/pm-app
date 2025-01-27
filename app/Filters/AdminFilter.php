<?php declare (strict_types = 1);

namespace App\Filters;   

use App\Models\User;

trait AdminFilter{

    public function before(User $user): bool|null
    {
        if ($user->isAdministrator()) {
            return true;
        }

        return null;
    }
}