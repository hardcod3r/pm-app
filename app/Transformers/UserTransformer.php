<?php declare(strict_types=1);

namespace App\Transformers;

use App\Abstract\Transformers\BaseTransformer;
use App\Enums\Role;
class UserTransformer extends BaseTransformer
{
    public function transform($user): array
    {
        $data =  [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => Role::getValue($user->role),
            'role_description' => Role::getDescription($user->role),
            'created_at' => $user->created_at->toDateTimeString(),
        ];
        if ($user->relationLoaded('companies')) {
            $data['companies'] = (new CompanyTransformer())->transformCollection($user->companies);
        }

        return $data;
    }
    
}
