<?php

namespace App\Http\Requests\Company;

use App\Abstract\Requests\BaseRequest;
use App\Rules\UniqueNameVat;

class StoreCompanyRequest extends BaseRequest
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
            'country_id' => 'required|exists:countries,id',
            'address' => 'required|string',
            'vat_id' => ['required', 'string', 'max:255', new UniqueNameVat()],
            'logo' => 'nullable|string|max:255',
            'website' => 'nullable|string|url|max:255',
        ];
    }
}
