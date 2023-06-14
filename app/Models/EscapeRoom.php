<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class EscapeRoom extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
    ];

    public function theme(): BelongsTo
    {
        return $this->belongsTo(EscapeRoomTheme::class, 'escape_room_theme_id', 'id');
    }

    public function dates(): HasMany
    {
        return $this->hasMany(EscapeRoomDate::class);
    }
}
