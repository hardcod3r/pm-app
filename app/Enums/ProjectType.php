<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Attributes\Description;

/**
 * @method static static Standard()
 * @method static static Complex()
 */
#[Description('The type of the project')]
final class ProjectType extends Enum
{
    #[Description('Standard project')]
    const Standard = 1;
    #[Description('Complex project')]
    const Complex = 2;

    public static function asArray(): array
    {
        return [
            self::Standard,
            self::Complex,
        ];
    }

}
