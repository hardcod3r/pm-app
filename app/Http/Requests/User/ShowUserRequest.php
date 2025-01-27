<?php

namespace App\Http\Requests\User;

use App\Abstract\Requests\BaseRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
class ShowUserRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    protected $model = User::class;

    public function authorize(): bool
    {
        return Gate::allows('view', $this->route('user'), $this->model);
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
