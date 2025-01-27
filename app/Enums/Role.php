<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Attributes\Description;

/**
 * @method static static User()
 * @method static static Admin()
 */
#[Description('The role of the user')]
final class Role extends Enum
{
    #[Description('User role')]
    const User = 1;
    #[Description('Admin role')]
    const Admin = 2;

}
