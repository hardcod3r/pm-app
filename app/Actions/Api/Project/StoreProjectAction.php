<?php declare (strict_types = 1);   

namespace App\Actions\Api\Project;

use App\Http\Resources\ProjectResource;
use App\Models\Project;

class StoreProjectAction
{
    /**
     * Execute the action.
     *  
     * @param array $data
     * @return mixed
     */
    public function run(array $data)
    {
        try {
            $project = Project::create($data);
            return new ProjectResource($project);
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Unable to create project',
                'errors' => [$e->getMessage()],
            ];
        }
    }
}