<?php declare(strict_types=1);

namespace App\Abstract\Collections;

use Illuminate\Http\Resources\Json\ResourceCollection;

abstract class BaseCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request) : array
    {
        return [
            'success' => true,
            'data' => $this->collection,
        ];
    }
}
