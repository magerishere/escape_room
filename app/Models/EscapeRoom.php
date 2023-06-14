<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class EscapeRoom extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'max_uses',
    ];

    protected $casts = [
        'max_uses' => 'int',
    ];

    public function dates(): HasMany
    {
        return $this->hasMany(EscapeRoomDate::class);
    }

    public function isFulled(): bool
    {
        $times = collect();
        $this->dates->each(function ($date) use ($times) {
            $date->times->each(fn($time) => $times->push($time));
        });
        return $this->max_uses >= $times->count();
    }
}
