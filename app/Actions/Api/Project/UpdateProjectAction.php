<?php declare(strict_types=1);

namespace App\Actions\Api\Project;

use App\Models\Project;

class UpdateProjectAction
{
    public function run(array $data, string $id): Project
    {
        try {
            $project = Project::findOrFail($id);
            $project->update($data);
            return $project;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}