<?php

declare(strict_types=1);

namespace App\Actions\Api\Project;

use App\Http\Resources\ProjectResource;  
use App\Filters\Contracts\ProjectFilter;

class GetProjectListAction
{
    protected ProjectFilter $filter;

    public function __construct(ProjectFilter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * Execute the action.
     *  
     * @return mixed
     */
    public function run()
    {
        try {
            $projects = $this->filter->getProjects();
            return ProjectResource::collection($projects);
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Unable to fetch projects',
                'errors' => [$e->getMessage()],
            ];
        }
    }
}
