<?php declare(strict_types=1);

namespace App\Models\Traits;

use App\Models\Company;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


trait BelongsToManyCompanies
{
    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }
}