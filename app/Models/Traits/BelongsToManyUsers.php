<?php declare(strict_types=1);

namespace App\Models\Traits;

use App\Models\User;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait BelongsToManyUsers
{
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}