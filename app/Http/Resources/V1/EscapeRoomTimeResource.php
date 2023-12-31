<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EscapeRoomTimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'capacity' => $this->capacity,
            'remaining_capacity' => $this->remainingCapacity,
            'begin' => $this->begin->format('H:i:s'),
            'end' => $this->end->format('H:i:s'),
            'price' => $this->price,
        ];
    }
}
