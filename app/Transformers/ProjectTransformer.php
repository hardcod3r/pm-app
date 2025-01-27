<?php declare(strict_types=1);

namespace App\Transformers;

use App\Abstract\Transformers\BaseTransformer;

class ProjectTransformer extends BaseTransformer
{
    public function transform($project): array
    {
        $data =  [
            'name' => $project->name,
            'description' => $project->description,
            'start_date' => $project->start_date->toDateString(),
            'end_date' => $project->end_date->toDateString(),
            'country' => $project->country->name,
            'status' => $project->status,
            'created_at' => $project->created_at->toDateTimeString(),
        ];

        if ($project->relationLoaded('company')) {
            $data['company'] = (new CompanyTransformer())->transform($project->company);
        }

        return $data;
    }
}