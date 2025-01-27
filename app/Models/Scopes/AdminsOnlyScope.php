<?php declare (strict_types = 1);

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use App\Enums\Role;

trait AdminsOnlyScope
{
    public function scopeAdminsOnly(Builder $query): Builder
    {
        return $query->where('role', Role::Admin);
    }

    public function scopeExceptUserId(Builder $query, $id): Builder
    {
        return $query->where('id', '!=', $id);
    }
}