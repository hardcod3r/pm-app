<?php declare(strict_types=1);

namespace App\Models\Traits;


use App\Models\Project;
use App\Models\CompanyUser;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

trait HasManyProjectsThrough
{
    public function projects(): HasManyThrough
    {
        return $this->hasManyThrough(Project::class, CompanyUser::class, 'user_id', 'company_id', 'id', 'company_id');
    }
}