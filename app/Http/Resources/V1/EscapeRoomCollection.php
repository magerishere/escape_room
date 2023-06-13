<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EscapeRoomCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'data' => $this->collection->map(function ($escapeRoom) {
                return [
                    'id' => $escapeRoom->id,
                    'title' => $escapeRoom->title,
                    'max_uses' => $escapeRoom->max_uses,
                ];
            }),
        ];
    }
}
