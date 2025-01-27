<?php declare (strict_types = 1);

namespace App\Filters;

use App\Models\Project;
use App\Filters\Contracts\ProjectFilter;

class AdminProjectFilter implements ProjectFilter
{
    public function getProjects() : mixed
    {
        return Project::paginate();
    }
}
