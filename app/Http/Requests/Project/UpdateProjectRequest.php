<?php

namespace App\Http\Requests\Project;

use App\Abstract\Requests\BaseRequest;
use App\Enums\ProjectType;
use App\Enums\ProjectPhase;
class UpdateProjectRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->onlyAdminCanAccess();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'company_id' => 'sometimes|exists:companies,id',
            'phase' => 'sometimes|in:' . implode(',', ProjectPhase::asArray()),
            'project_type' => 'sometimes|in:' . implode(',', ProjectType::asArray()),
            'budget' => 'present_if:project_type,' . ProjectType::Complex . '|numeric|min:1|max:999999999',
            'timeline' => 'present_if:project_type,' . ProjectType::Complex . '|json',
            'timeline.*.start_date' => 'required|date',
            'timeline.*.end_date' => 'required|date',
        ];
    }
}
