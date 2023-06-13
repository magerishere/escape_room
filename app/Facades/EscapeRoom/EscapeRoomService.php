<?php

namespace App\Facades\EscapeRoom;

use App\Models\EscapeRoom;
use Illuminate\Database\Eloquent\Collection;

class EscapeRoomService
{
    /**
     * Get all escape rooms
     * @return Collection
     */
    public function getAll(): Collection
    {
        return EscapeRoom::all();
    }
}
