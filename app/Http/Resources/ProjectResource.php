<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Abstract\Resources\BaseResource;
use App\Enums\ProjectPhase;
use App\Enums\ProjectType;
use App\Models\Project;

class ProjectResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data =  [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'type' => ProjectType::fromValue($this->project_type)->description,
            'phase' => ProjectPhase::fromValue($this->phase)->description,
            'budget' => ($this->budget > 0) ? $this->currency_price : null, 
            'timeline' => (!empty($this->timeline)) ? $this->timeline: null,
        ];

        if ($this->ifAdmin()) {
            $data['created_at'] = $this->created_at->format('Y-m-d H:i:s');
            $data['updated_at'] = $this->updated_at->format('Y-m-d H:i:s');
            $data['created_since'] = $this->created_at->diffForHumans();
        }

        return $data;
    }
}
