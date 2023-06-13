<?php

namespace App\Facades\EscapeRoomTheme;


use App\Models\EscapeRoomTheme;
use Illuminate\Database\Eloquent\Collection;

class EscapeRoomThemeService
{
    public function getAll(): Collection
    {
        return EscapeRoomTheme::all();
    }
}
