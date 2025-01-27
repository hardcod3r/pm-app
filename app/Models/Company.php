<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use App\Models\Traits\BelongsToCountry;
use App\Models\Traits\HasManyProjects;
use App\Models\Traits\BelongsToManyUsers;
class Company extends Model
{
    use HasFactory, HasUlids;
    use BelongsToCountry;
    use HasManyProjects;
    use BelongsToManyUsers;
    
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
    protected $fillable = ['name', 'address', 'vat_id', 'logo', 'website', 'country_id'];
    
}
