<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EscapeRoom extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'max_uses',
        'price'
    ];

    protected $casts = [
        'max_uses' => 'int',
        'price' => 'int',
    ];

    public function dates()
    {
        return $this->hasMany(EscapeRoomDate::class);
    }
}
