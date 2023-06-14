<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'escape_room_time_id',
        'price',
        'discount_price',
    ];

    protected $casts = [
        'price' => 'int',
        'discount_price' => 'int'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function time(): BelongsTo
    {
        return $this->belongsTo(EscapeRoomTime::class, 'escape_room_time_id', 'id');
    }

}
