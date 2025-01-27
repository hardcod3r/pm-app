<?php declare(strict_types=1);

namespace App\Models\Traits;

use App\Models\Country;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
trait BelongsToCountry
{
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}