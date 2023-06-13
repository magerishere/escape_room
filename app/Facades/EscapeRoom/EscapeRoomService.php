<?php

namespace App\Facades\EscapeRoom;

use App\Models\EscapeRoom;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function getAllAsPaginate(int $perPage = 20): LengthAwarePaginator
    {
        return EscapeRoom::paginate($perPage);
    }

}
