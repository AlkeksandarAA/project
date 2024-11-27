<?php

namespace App\Listeners;

use App\Events\TicketPurchese;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Event;
use App\Models\User;


class PurchesTicketNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TicketPurchese $event): void
    {
        $user = User::findOrFail($event->user);

        $alreadyPurchased = $user->PurcheseTickets()->wherePivot('event_id', $event->event)->exists();
     
        if(!$alreadyPurchased){
        $user->PurcheseTickets()
       ->attach($event->event,[
        'ticket_id' => $event->ticket, 
        'purchese_made' => now(),
       ]);
    }else {
    }
    }
}
