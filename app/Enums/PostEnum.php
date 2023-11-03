<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PostEnum extends Enum
{
    //status 
    const Pendding = 0; //dang xu ly
    const Approved = 1; //dang hoat dong
    const Cancel = 2; // da huy
    const PenddingTemp = 3; // biến tạm
}
