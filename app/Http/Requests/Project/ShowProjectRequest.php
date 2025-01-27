<?php

namespace App\Http\Requests\Project;

use App\Abstract\Requests\BaseRequest;

class ShowProjectRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->onlyAdminCanAccess()  || (in_array($this->route('project')->id, $this->user()->projects->pluck('id')->toArray())) ? true : false;
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
