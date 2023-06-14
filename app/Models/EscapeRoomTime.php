<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public function date()
    {
        return $this->belongsTo(EscapeRoomDate::class);
    }


}
