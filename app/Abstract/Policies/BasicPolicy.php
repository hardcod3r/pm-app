<?php declare(strict_types=1);

namespace App\Abstract\Policies;

use App\Filters\AdminFilter;

abstract class BasicPolicy
{
    use AdminFilter;

    
    protected function deny()
    {
        abort(response()->json([
            'status' => 'error',
            'message' => 'Unauthorized',
            'errors' => ['You are not authorized to perform this action'],
        ], 403));
    }
}