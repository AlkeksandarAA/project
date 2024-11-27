@extends('master.layout')
@section('content')

@foreach($users as $user) 
<div class="col-8 mx-auto d-flex mt-4 justify-content-around align-items-center text-center">
<div class="col-2">
<img src="{{asset($user->img)}}" alt="pp" class="img-fluid rounded-circle">
</div>
<div>
<div>
{{$user->name}}
{{$user->lastname}} 
</div>
{{$user->email}}
<div>
    <a href="{{route('show.user', $user->id)}}" class="btn btn-secondary">Show user profile</a>
</div>
</div>
<div class="d-flex">
<a href="destroy.user" class="btn btn-danger">Delete</a>
@if(auth()->user()->role_id === 3)
@if($user->role_id === 1) 
    <form action="{{ route('update.admin', ['user' => $user->id]) }}" method="POST" id="makeAdmin" class="ms-2">
        @method('PATCH')
        @csrf
        <input type="hidden" value="make" name="action">
        <button type="submit" class="btn btn-success">Make Admin</button>
    </form>
@elseif($user->role_id === 2) 
    <form action="{{ route('update.admin', ['user' => $user->id]) }}" method="POST" id="removeAdmin" class="ms-2">
        @method('PATCH')
        @csrf
        <input type="hidden" value="remove" name="action">
        <button type="submit" class="btn btn-warning">Remove Admin</button>
    </form>
@endif
@endif
</div>
</div>

{{-- {{dd($user)}} --}}

@endforeach

@endsection