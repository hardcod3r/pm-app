<?php

namespace App\Http\Requests\Project;

use App\Abstract\Requests\BaseRequest;


class AssignProjectToCompanyRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //only admin can access this route
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
            
        ];
    }
}
