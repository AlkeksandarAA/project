<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuestRequest;
use App\Models\Guest;
use Illuminate\Http\Request;
use App\Models\Event;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(GuestRequest $request,Event $event)
    {
        $validateData = $request->validated();

        $validateData['event_id'] = $event->id;

        Guest::create($validateData);

        $event = Event::findOrFail($event->id);

        return redirect()->route('show.event' , $event->id );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuestRequest $request ,Event $event)
    {
            $validateData = $request->validated();

            $validateData['event_id'] = $event->id;

            Guest::create($validateData);

            return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $guest = Guest::findOrFail($id);
        $guest->delete();

        return redirect()->back();
    }
}
