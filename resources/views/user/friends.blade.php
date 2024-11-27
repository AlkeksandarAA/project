@extends('master.layout')

@section('content')

<div class="text-center mt-5">
<h1>All you friends</h1>

<div class="d-flex flex-wrap justify-content-center col-10 offset-1">
    @foreach($user->friends as $friend)
      <div class="col-2 text-center mb-4 mx-4">
        <form action="{{route('show.user', $friend->id)}}">
        <button class="btn">
        <img src="{{ asset($friend->img) }}" alt="Friend Image" class="img-fluid d-block rounded-circle">
        <p class="mt-2">{{ $friend->name }} {{ $friend->lastname }}</p>
        </button>
    </form>
      </div>
    @endforeach
  </div>
</div>
@endsection