<?php

namespace App\Http\Requests\User;


use App\Abstract\Requests\BaseRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\User;


class CreateUserRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    protected $model = User::class;


    public function authorize(): bool
    {
        return Gate::allows('create', $this->model);
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
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8|max:255',
            'password_confirmation' => 'required|same:password'
        ];
    }
}
