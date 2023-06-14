<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
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

    public function escapeRoomTime()
    {
        return $this->belongsTo(EscapeRoomTime::class);
    }

}
