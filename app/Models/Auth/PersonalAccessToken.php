<?php

namespace App\Models\Auth;

use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
class PersonalAccessToken extends SanctumPersonalAccessToken
{
    use HasUlids;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */

    protected $keyType = 'string';
    protected $primaryKey = 'id';
    
}
