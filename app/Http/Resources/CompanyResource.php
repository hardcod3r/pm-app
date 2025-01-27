<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Abstract\Resources\BaseResource;
use App\Http\Collections\ProjectCollection;
class CompanyResource extends BaseResource
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
            'country' => $this->country->name,
            'address' => $this->address,
            'vat' => (string) $this->vat_id,
            'logo' => $this->logo,
            'website' => $this->website,
        ];

        if ($this->ifAdmin()) {
            $data['created_at'] = $this->created_at->format('Y-m-d H:i:s');
            $data['updated_at'] = $this->updated_at->format('Y-m-d H:i:s');
            $data['created_since'] = $this->created_at->diffForHumans();
        }

        if($this->relationLoaded('projects')) {
            $data['projects'] = array_map(function($project) {
                return new ProjectResource($project);
            }, $this->projects->all());
        }

        return $data;
    }
}
