<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookingCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($booking) {
                return [
                    'id' => $booking->id,
                    'price' => $booking->price,
                    'discount_price' => $booking->discount_price,
                    'time' => new EscapeRoomTimeResource($booking->time),
                ];
            }),
        ];
    }
}
