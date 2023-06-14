<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EscapeRoomDateResource extends JsonResource
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
            'available_at' => $this->available_at->format('Y-m-d'),
            'times' => EscapeRoomTimeResource::collection($this->times),

        ];
    }
}
