<?php

namespace App\Http\Controllers\Api\V1;

use App\Facades\EscapeRoom\EscapeRoomFacade;
use App\Http\Resources\V1\EscapeRoomCollection;
use App\Models\EscapeRoom;
use Illuminate\Http\Request;

class EscapeRoomController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(new EscapeRoomCollection(EscapeRoomFacade::getAll()));
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
        //
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
