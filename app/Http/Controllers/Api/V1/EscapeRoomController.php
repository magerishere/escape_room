<?php

namespace App\Http\Controllers\Api\V1;

use App\Facades\EscapeRoom\EscapeRoomFacade;
use App\Http\Resources\V1\EscapeRoomCollection;
use App\Http\Resources\V1\EscapeRoomDateResource;
use App\Http\Resources\V1\EscapeRoomResource;
use App\Models\EscapeRoom;
use Illuminate\Http\Request;

class EscapeRoomController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new EscapeRoomCollection(EscapeRoomFacade::getAllAsPaginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(EscapeRoom $escapeRoom)
    {
        return new EscapeRoomResource($escapeRoom);
    }

    public function showTimes(EscapeRoom $escapeRoom)
    {
        return EscapeRoomDateResource::collection($escapeRoom->dates);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EscapeRoom $escapeRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EscapeRoom $escapeRoom)
    {
        //
    }
}
