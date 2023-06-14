<?php

namespace App\Http\Controllers\Api\V1;

use App\Facades\Booking\BookingFacade;
use App\Http\Requests\Api\V1\BookingStoreRequest;
use App\Http\Resources\V1\BookingCollection;
use App\Http\Resources\V1\BookingResource;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new BookingCollection(BookingFacade::getAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingStoreRequest $request)
    {
        $booking = BookingFacade::create($request->get('escape_room_time_id'));
        return new BookingResource($booking);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
