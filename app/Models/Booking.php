<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function time()
    {
        return $this->belongsTo(EscapeRoomTime::class, 'escape_room_time_id', 'id');
    }

}
