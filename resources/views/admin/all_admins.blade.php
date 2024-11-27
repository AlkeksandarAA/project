@extends('master.layout')
@section('content')

@foreach($admins as $admin) 
<div class="col-8 mx-auto d-flex mt-4 justify-content-around align-items-center text-center">
<div class="col-2">
<img src="{{asset($admin->img)}}" alt="pp" class="img-fluid rounded-circle">
</div>
<div>
<div>
{{$admin->name}}
{{$admin->lastname}} 
</div>
{{$admin->email}}
<div>
    <a href="{{route('show.user', $admin->id)}}" class="btn btn-secondary">Show user profile</a>
</div>
</div>
<div class="d-flex">
<a href="destroy.user" class="btn btn-danger">Delete</a>
    <form action="{{ route('update.admin', ['user' => $admin->id]) }}" method="POST" id="removeAdmin" class="ms-2">
        @method('PATCH')
        @csrf
        <input type="hidden" value="remove" name="action">
        <button type="submit" class="btn btn-warning">Remove Admin</button>
    </form>
</div>
</div>
@endforeach
@endsection