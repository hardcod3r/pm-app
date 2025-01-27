<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Role;
use App\Abstract\Requests\BaseRequest;
class UpdateUserRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //another authorization logic
        return $this->onlyAdminCanAccess();
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user'); // get the user id from the route
        $rules =  [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' .  $userId,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:' . Role::Admin . ',' . Role::User,
        ];
        //in case that the user is not an admin (may in future grant access to users for it), we will remove the role field from the rules
        if (! $this->onlyAdminCanAccess()) {
            unset($rules['role']);
        }
        return $rules;
    }
    
}
