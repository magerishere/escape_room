<?php

namespace App\Facades\EscapeRoom;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Collection getAll
 * @method static LengthAwarePaginator getAllAsPaginate
 */
class EscapeRoomFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'escape.room.facade';
    }
}
