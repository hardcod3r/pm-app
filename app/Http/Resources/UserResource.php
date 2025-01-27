<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Abstract\Resources\BaseResource;
use App\Enums\Role;

class UserResource extends BaseResource
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
            'first_name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'role' => Role::fromValue($this->role)->description,
        ];

        if ($this->ifAdmin()) {
            $data['created_at'] = $this->created_at->format('Y-m-d H:i:s');
            $data['updated_at'] = $this->updated_at->format('Y-m-d H:i:s');
            $data['created_since'] = $this->created_at->diffForHumans();
        }

        if($this->relationLoaded('companies')) {
            $data['companies'] = array_map(function($company) {
                return new CompanyResource($company);
            }, $this->companies->all());
        }

        if($this->relationLoaded('projects')) {
            $data['projects'] = array_map(function($project) {
                return new ProjectResource($project);
            }, $this->projects->all());
        }
        return $data;
    }
}
