<?php

namespace App\Facades\EscapeRoomTime;

use App\Models\EscapeRoomTime;
use Illuminate\Support\Facades\Facade;

/**
 * @method static null|EscapeRoomTime getById(int $id)
 */
class EscapeRoomTimeFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'escape_room_time_facade';
    }
}
