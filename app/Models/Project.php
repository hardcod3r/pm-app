<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use App\Casts\PriceValue;
use App\Enums\ProjectType;
use App\Enums\ProjectPhase;
use App\Models\Traits\BelongsToCompany;
use App\Models\Attributes\CurrencyPriceAttribute;
class Project extends Model
{
    use HasFactory, HasUlids, BelongsToCompany;
    use CurrencyPriceAttribute;
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

    protected $fillable = ['name', 'project_type','description', 'budget', 'timeline', 'phase', 'project_type'];

    protected $casts = [
        'project_type' => ProjectType::class,
        'timeline' => AsArrayObject::class,
        'budget' => PriceValue::class,
        'phase' => ProjectPhase::class,
    ];

    protected $appends  = ['currency_price'];
    
}
