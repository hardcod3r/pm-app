<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use App\Abstract\Requests\BaseRequest;
use Illuminate\Support\Facades\Gate;
class ViewCompanyRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       //check if the user.companies has the company id
        return $this->onlyAdminCanAccess()  || (in_array($this->route('company')->id, $this->user()->companies->pluck('id')->toArray())) ? true : false;
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
