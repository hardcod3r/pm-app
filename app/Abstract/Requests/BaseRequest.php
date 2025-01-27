<?php
namespace App\Abstract\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Role;
abstract class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedAuthorization()
    {
        // Throw a custom JSON response for unauthorized access
        abort(response()->json(['success' => false ,'message' => 'You are not authorized to perform this action.'], 403));
    }

    protected function onlyAdminCanAccess()
    {
        return auth()->user()->role === Role::Admin;
    }
}
