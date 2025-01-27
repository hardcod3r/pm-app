<?php declare(strict_types=1);

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class PriceValue implements CastsAttributes
{
    /**
     * Transform the value from cents to dollars when retrieving it.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes) : float
    {
        return $value / 100; // Convert cents to dollars
    }

    /**
     * Transform the value from dollars to cents when setting it.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes) : int
    {
        return (int)($value * 100); // Convert dollars to cents
    }
}
