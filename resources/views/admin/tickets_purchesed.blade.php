@extends('master.layout')
@section('content')
<h1 class="text-center mt-3 mb-2"> Сите купени карти</h1>
    <div class="col-9 mx-auto">
    @foreach($tickets as $ticket)
    <h2>{{$ticket->title}}</h2>
    <div class="col-3">
    @foreach($ticket->PurcheseTickets as $ticketPurches)
    {{$ticketPurches->name}} purchesed ticket at : {{$ticketPurches->pivot->purchese_made}}
    <p>Ticket price: {{$ticketPurches->ticket->ticket_price}}</p>
    @endforeach
</div>
    @endforeach
</div>
@endsection