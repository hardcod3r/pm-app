<?php declare(strict_types=1);

namespace App\Models\Traits;

use App\Models\Project;
use Illuminate\Database\Eloquent\Relations\HasMany;
trait HasManyProjects
{
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}