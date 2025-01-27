<?php

namespace App\Http\Requests\Company;

use App\Abstract\Requests\BaseRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\Company;
class DestroyCompanyRequest extends BaseRequest
{

    protected $model = Company::class;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('delete', $this->route('company'), $this->model);
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
