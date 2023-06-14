<?php

namespace App\Facades\EscapeRoomTime;

use Illuminate\Support\Facades\Facade;

/**
 *
 */
class EscapeRoomTimeFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'escape_room_time_facade';
    }
}
