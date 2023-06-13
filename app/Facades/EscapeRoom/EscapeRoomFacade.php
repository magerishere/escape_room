<?php

namespace App\Facades\EscapeRoom;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Collection getAll()
 */
class EscapeRoomFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'escape.room.facade';
    }
}
