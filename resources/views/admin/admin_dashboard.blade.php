@extends('master.layout')
@section('content')


<div class="d-flex justify-content-between mt-5 col-10 mx-auto">
<div class="card col-3">
    <div class="card-body">
      <h3 class="card-title">Users</h3>
      <p class="card-text ms-3  fs-5">Total Users: <b>{{$users->count()}}</b></p>
      <a href="{{route('all.users')}}" class="btn btn-primary">Expand</a>
    </div>
  </div>
  <div class="card col-3">
    <div class="card-body">
      <h3 class="card-title">Posts</h3>
      <p class="card-text ms-3 fs-5"> Total Posts: <b>{{$posts->count()}}</b></p>
      <a href="{{route('all.posts')}}" class="btn btn-primary">Expand</a>
    </div>
  </div>
  <div class="card col-3">
    <div class="card-body">
      <h3 class="card-title">Purchesed Tickets</h3>
      <p class="card-text ms-3 fs-5">Total Tickets purchesed: <b>{{$purchesedTickets->count()}}</b></p>
      <a href="{{route('purchesed.tickets')}}" class="btn btn-primary">Expand</a>
    </div>
  </div>
</div>
<div class="d-flex justify-content-between mt-5 col-10 mx-auto">
    <div class="card col-3">
        <div class="card-body">
          <h3 class="card-title">Blogs</h3>
          <p class="card-text ms-3  fs-5">Total Blogs: <b>{{$blogs->count()}}</b></p>
        </div>
      </div>
      <div class="card col-3">
        <div class="card-body">
          <h3 class="card-title">Events</h3>
          <p class="card-text ms-3 fs-5">Total events: <b>{{$events->count()}}</b></p>
        </div>
      </div>
      <div class="card col-3">
        <div class="card-body">
          <h3 class="card-title">Confrences</h3>
          <p class="card-text ms-3 fs-5">Total confrences: <b>{{$conferences->count()}}</b></p>
        </div>
      </div>
    </div>
    @if(auth()->user()->role_id === 3)
    <div class="d-flex justify-content-between mt-5 col-10 mx-auto">
    <div class="card col-12 text-center">
        <div class="card-body">
          <h3 class="card-title">Admins</h3>
          <p class="card-text ms-3 fs-5">Total Admins: <b>{{$admins->count()}}</b></p>
          <a href="{{route('all.admins')}}" class="btn btn-primary">Expand</a>
        </div>
      </div>
    </div>

    @endif

@endsection
<script>

</script>