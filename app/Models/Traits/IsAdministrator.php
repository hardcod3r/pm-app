<?php declare(strict_types=1);

namespace App\Models\Traits;
use App\Enums\Role;
trait IsAdministrator
{
    /**
     * Determine if the user is an administrator.
     *
     * @return bool
     */
    public function isAdministrator(): bool
    {
        return $this->role === Role::Admin;
    }
}
