<?php declare(strict_types=1);

namespace App\Enums;
use BenSampo\Enum\Attributes\Description;
use BenSampo\Enum\Enum;

/**
 * @method static static Pending()
 * @method static static Planning()
 * @method static static Design()
 * @method static static Development()
 * @method static static Testing()
 * @method static static Deployment()
 * @method static static Maintenance()
 */
#[Description('The phase of the project')]
final class ProjectPhase extends Enum
{
    #[Description('The project is pending')]
    const Pending = 0;
    #[Description('The project is in the planning phase')]
    const Planning = 1;
    #[Description('The project is in the design phase')]
    const Design = 2;
    #[Description('The project is in the development phase')]
    const Development = 3;
    #[Description('The project is in the testing phase')]
    const Testing = 4;
    #[Description('The project is in the deployment phase')]
    const Deployment = 5;
    #[Description('The project is in the maintenance phase')]
    const Maintenance = 6;

}
