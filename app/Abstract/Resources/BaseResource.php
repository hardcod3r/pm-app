<?php declare(strict_types=1);

namespace App\Abstract\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use App\Enums\Role;
abstract class BaseResource extends JsonResource
{
    public $preserveKeys = true;

    protected function ifAdmin() : bool
    {
        return Auth::user()->isAdministrator();
    }


    
}
