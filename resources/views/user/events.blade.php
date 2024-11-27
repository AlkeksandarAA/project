@extends('master.layout')

@section('content')
    <div class="event-container pt-5 pb-5">
        @if (auth()->user()->role_id === 2 || auth()->user()->role_id === 3)
        <form action="{{route('create.event')}}" method="GET">
            <button class="btn">Направи нов настан</button>
        </form>
        @endif
        @foreach($events as $event)
        <x-event-component :type="$event"></x-event-component>
        @endforeach
    </div>

@endsection