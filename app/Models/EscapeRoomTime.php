<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EscapeRoomTime extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'begin',
        'end',
        'price'
    ];

    protected $casts = [
        'begin' => 'date:H:i:s',
        'end' => 'date:H:i:s',
        'price' => 'int'
    ];

    public function date(): BelongsTo
    {
        return $this->belongsTo(EscapeRoomDate::class, 'escape_room_date_id', 'id');
    }

    public function room(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->date->room,
        );
    }


}
