<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\Event;
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('PurcheseTickets', 'ticket', 'guest')->get();

        return view('user.events', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.create_event');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $validatedData = $request->validated();

        $event = Event::create($validatedData);

        $validateTicket = $request->validate([
            'ticket_price' => 'required|numeric'
        ]);

        $validateTicket['event_id'] =
            $ticket = Ticket::create(array_merge($validateTicket, ['event_id' => $event->id]));

        return view('admin.add_guest', compact(['event', 'ticket']));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $event = Event::with('ticket', 'guest', 'PurcheseTickets')->findOrFail($id);

        $user = auth()->user();

        $event->user_has_ticket = $user->PurcheseTickets->contains($event->id);


        return view('user.show_event', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::with('PurcheseTickets', 'ticket', 'guest')->findOrFail($id);
        return view('admin.edit_event', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, Event $event)
    {
        $validatedEvent = $request->validated();

        $event->update($validatedEvent);

        $validateTicket = $request->validate([
            'ticket_price' => 'required|numeric'
        ]);

        $ticket = Ticket::where('event_id', $event->id)->firstOrFail();

        $ticket->update($validateTicket);

        return redirect()->route('show.event', $event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('all.events');
    }
    public function conferance()
    {
        $conferences = Event::with('PurcheseTickets', 'ticket', 'guest')->where('conference', true)->get();
        return view('user.conference', compact('conferences'));
    }
}
