@extends('master.layout')

@section('content')
<div class="col-6 offset-3 d-flex flex-column align-items-end mb-4 mt-5">
@if(auth()->user()->role_id === 2 || auth()->user()->role_id === 3)
<div class="d-flex flex-column align-items-end">
<form action="{{ route('destroy.event', ['event' => $event->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn bg-danger mb-1" type="submit">Delete Event</button>
</form>
<form action="{{ route('edit.event' , $event->id) }}" method="GET">
    <button type="submit" class="btn bg-info ">Edit</button>
</form>
</div>
@endif
<h5>{{$event->location}}</h5>
<p>{{$event->date}}</p>
</div>

<div class="col-6 offset-3 d-flex justify-content-start">
<div>
<h2 class="text-uppercase">{{$event->title}}</h2>
<blockquote>
  <p class="ms-5 fs-4 text">{{$event->theme}}</p>
</blockquote>
<div class="ms-3">
<h3 class="text-uppercase">Опис: </h3>
<p class="ms-5 fs-4 text">{{$event->about}}</p>
</div>
</div>
</div>
<div class="col-6 offset-3 d-flex justify-content-end mb-4">
  <div class="text-center">
  @foreach ($event->guest as $guest)
  <h3 class="text-uppercase">Гостин</h3>
  <h5>{{$guest->name}}</h5>
  <h5>{{$guest->about}}</h5>
  @endforeach
  </div>
</div>
<div class="col-6 offset-3 d-flex justify-content-center text-center mt-5">
<form action="{{ route('purchese.ticket', ['ticket' => $event->ticket->id, 'event' => $event->id]) }}" method="POST">
  @csrf
  <p>Цена на карта: {{$event->ticket->ticket_price}}</p>
  <button type="submit" class="{{ $event->user_has_ticket ? 'btn disabled bg-success' : 'btn btn-primary' }}">
    {{ $event->user_has_ticket ? 'Веќе купивте  карата' : 'Купи карта' }}
  </button>
</form>
</div>



@endsection