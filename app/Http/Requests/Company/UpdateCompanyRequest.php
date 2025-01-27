<?php

namespace App\Http\Requests\Company;

use App\Rules\UniqueNameVat;
use App\Abstract\Requests\BaseRequest;
use Illuminate\Support\Facades\Gate;
class UpdateCompanyRequest extends BaseRequest
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
            'address' => 'nullable|string',
            'vat_id' => ['nullable', 'string', 'max:255', new UniqueNameVat()],
            'logo' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
        ];
    }
}
