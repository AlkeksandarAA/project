@extends('master.layout')

@section('content')
<style>
    .hidden {
        opacity: 0;
    visibility: hidden;
    transition: opacity 0.2s ease, visibility 0.2s ease;
    position: absolute;
}
.show{
    opacity: 1;
    visibility: visible;
    position: relative;
}
</style>



<x-error></x-error>

<h2>Edit event: {{$event->title}} </h2>


<form action="{{route('update.event', ['event' => $event->id])}}" method="POST">
    @method('PUT')
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Назив</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" value=" {{ $event->title ?? '' }}">
      </div>
      <div class="mb-3">
        <label for="about" class="form-label"></label>
        <input type="text" class="form-control" id="about" name="about" value="{{ $event->about ?? '' }}">
      </div>
      <div class="mb-3">
        <label for="date" class="form-label">Датму</label>
        <input type="datetime" class="form-control" id="date" name="date" value="{{ $event->date ?? '' }}">
      </div>
      <div class="mb-3">
        <label for="ticket_price" class="form-label">Цена на карта</label>
        <input type="number" class="form-control" id="ticket_price" name="ticket_price" value="{{ $event->ticket->ticket_price ?? '' }}">
      </div>
      <div class="mb-3">
        <label for="theme" class="form-label">Тема</label>
        <input type="number" class="form-control" id="theme" name="theme" value="{{ $event->theme ?? '' }}">
      </div>
      <div class="mb-3">
        <label for="location" class="form-label">Локација</label>
        <input type="number" class="form-control" id="location" name="location" value="{{ $event->location ?? '' }}">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
      @foreach($event->guest as $guest)
      <div class="mb-3">
        <label for="name" class="form-label">Guestname</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $guest->name ?? '' }}">
      </div>
      <div class="mb-3">
        <label for="about" class="form-label">Guest about</label>
        <input type="text" class="form-control" id="about" name="about" value="{{ $guest->about ?? '' }}">
      </div>
      <form action="{{ route ('delete.guest' , $guest->id) }}" method="POST"> 
        @csrf
        @method('DELETE')
        <button type="submit">Delete Guest</button>
      </form>
      @endforeach 
      <form action="{{ route ('create.guest' , ['event' => $event->id]) }}" method="POST">  
        @csrf
        <div class="hidden" id="hidden">
            <div class="mb-3">
                <label for="name" class="form-label">Guest name</label>
                <input type="text" class="form-control" id="name" name="name">
              </div>
              <div class="mb-3">
                <label for="about" class="form-label">Guest about</label>
                <input type="text" class="form-control" id="about" name="about">
              </div>
           <button type="submit">Submit</button>
        </div>
        <button type="button" class="btn bnt-sm bg-info" id="add">Add Guest</button>
      </form>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
         document.querySelector('#add').addEventListener('click', function(e) {
                 e.preventDefault();
                 document.querySelector('#hidden').classList.toggle('show');
             });
         });
 </script>