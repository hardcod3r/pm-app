<?php declare(strict_types=1);

namespace App\Models\Attributes;
use Illuminate\Database\Eloquent\Casts\Attribute;
trait CurrencyPriceAttribute
{
    public function getCurrencyPriceAttribute(): string
    {
        if (!$this->budget > 0) {
            return '';
        }
        return $this->budget. ' ' . config('project.currency_symbol');
    }
}