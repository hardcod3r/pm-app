<?php

namespace App\Http\Requests\Project;

use App\Abstract\Requests\BaseRequest;
use App\Enums\ProjectType;
use App\Enums\ProjectPhase;
class StoreProjectRequest extends BaseRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'company_id' => 'sometimes|exists:companies,id',
            'project_type' => 'required|in:' . implode(',', ProjectType::asArray()),
            'phase' => 'required|in:' . implode(',', ProjectPhase::asArray()),
            'budget' => 'required_if:project_type,' . ProjectType::Complex . '|numeric|min:1|max:999999999',
            'timeline' => 'required_if:project_type,' . ProjectType::Complex . '|array',
            'timeline.start_date' => 'date|before_or_equal:timeline.end_date',
            'timeline.end_date' => 'date|after_or_equal:timeline.start_date',
        ];
    }

    
}
