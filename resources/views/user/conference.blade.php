@extends('master.layout')
@section('content')

<div class="text-center mt-5">
    @if (auth()->user()->role_id === 2 || auth()->user()->role_id === 3)
    <form action="{{route('create.event')}}" method="GET">
        <button class="btn">Направи новa конференција</button>
    </form>
    @endif
    @if($conferences->isEmpty())
        <h1>Нема нови конференции</h1>
    @else
    <div class="event-container pt-5 pb-5">
        @foreach($conferences as $conference)
        <x-event-component :type="$conference"></x-event-component>
        @endforeach
    </div>
    @endif
</div>
@endsection