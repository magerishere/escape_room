<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class EscapeRoomTime extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'begin',
        'end',
        'price',
        'capacity'
    ];

    protected $casts = [
        'begin' => 'date:H:i:s',
        'end' => 'date:H:i:s',
        'price' => 'int',
        'capacity' => 'int'
    ];

    public function date(): BelongsTo
    {
        return $this->belongsTo(EscapeRoomDate::class, 'escape_room_date_id', 'id');
    }

    public function books(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function remainingCapacity(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->capacity - $this->books()->count(),
        );
    }

    public function isFulled(): Attribute
    {
        return Attribute::make(
            get: fn(): bool => $this->remainingCapacity <= 0
        );
    }




}
