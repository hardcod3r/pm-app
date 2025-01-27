<?php

declare(strict_types=1);

namespace App\Actions\Api\Project;

use App\Models\Project;
use App\Http\Resources\ProjectResource;

class ShowProjectAction
{
    public function run(Project $company, string $include): ProjectResource
    {
        $relationships = array_filter(explode(',', $include));
        $allowedRelationships = config('project.allowed_relationships.project');
        $validatedRelationships = array_filter($relationships, function ($relationship) use ($allowedRelationships) {
            return in_array($relationship, $allowedRelationships);
        });
        try {
            $project = $company->load($validatedRelationships);
            return new ProjectResource($project);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
