<?php

namespace App\Http\Resources;

use App\Http\Resources\V1\EscapeRoomTimeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        Log::alert($this->time);
        return [
            'id' => $this->id,
            'price' => $this->price,
            'escape_room_time_id' => $this->escape_room_time_id,
            'time' => new EscapeRoomTimeResource($this->time)
        ];
    }
}
