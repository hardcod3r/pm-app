<?php declare(strict_types=1);

namespace App\Abstract\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

abstract class ResourceController extends Controller
{
    
    protected function success($data = null, int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data
        ], $status);
    }
}