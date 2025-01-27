<?php

namespace App\Http\Requests\Project;

use App\Abstract\Requests\BaseRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\Project;
class DestroyProjectRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    protected $model = Project::class;
    
    public function authorize(): bool
    {
        return Gate::allows('delete', $this->route('project'), $this->model);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
