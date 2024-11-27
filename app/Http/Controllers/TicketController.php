<?php

namespace App\Http\Controllers;
use App\Events\TicketPurchese;
use App\Models\Ticket;
use App\Models\Event;


use Illuminate\Http\Request;

class TicketController extends Controller
{//{ticket}/event/{event}
    public function purchese(Request $request, int $ticket, int $event)
    {


        $user = auth()->id();
        if (!$user) {
            return redirect()->back()->with(['Error' => 'User not authenticated']);
        }

        event(new TicketPurchese($user, $event, $ticket));

        return redirect()->back()->with(['Succsess' => 'Ticket purchese succsesfull']);
    }
    public function purchesedTickets()
    {

        $tickets = Event::with([
            'PurcheseTickets'
        ])
            ->has('PurcheseTickets')->get();

        foreach ($tickets as $event) {
            foreach ($event->PurcheseTickets as $user) {
                $ticket = Ticket::find($user->pivot->ticket_id);
                $user->ticket = $ticket;
            }
        }



        return view('admin.tickets_purchesed', compact('tickets'));
    }
}
