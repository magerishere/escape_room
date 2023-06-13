<?php

namespace App\Facades\EscapeRoomTheme;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Collection getAll
 */
class EscapeRoomThemeFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'escape_room_theme_facade';
    }
}
