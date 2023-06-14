<?php

namespace App\Facades\EscapeRoomTime;


use App\Models\EscapeRoomTime;

class EscapeRoomTimeService
{
    /**
     * get by id
     * @param int $id
     * @return EscapeRoomTime|null
     */
    public function getById(int $id): ?EscapeRoomTime
    {
        return EscapeRoomTime::find($id);
    }
}
