<?php declare (strict_types = 1);

namespace App\Filters;

use App\Models\Project;
use App\Filters\Contracts\ProjectFilter;

class UserProjectFilter implements ProjectFilter
{
    public function getProjects() : mixed
    {
        return auth()->user()->projects; // This will return the projects that the user is associated with
    }
}
