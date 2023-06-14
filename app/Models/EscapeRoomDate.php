<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class EscapeRoomDate extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'available_at'
    ];

    protected $casts = [
        'available_at' => 'date:Y-m-d'
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(EscapeRoom::class);
    }

    public function times(): HasMany
    {
        return $this->hasMany(EscapeRoomTime::class);
    }
}
