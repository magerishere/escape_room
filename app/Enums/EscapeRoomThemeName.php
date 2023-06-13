<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class EscapeRoomThemeName extends Enum
{
    const HORROR = 'horror';
    const EXCITING = 'exciting';
    const PUZZLE = 'puzzle';
    const ESCAPE = 'escape';
}
