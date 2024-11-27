@extends('master.layout')
@section('content')


@foreach($posts as $post)

<div class="col-8 mx-auto d-flex mt-4 justify-content-around align-items-center text-center">
    <div class="col-2">
    <img src="{{asset($post->recommender->img)}}" alt="pp" class="img-fluid rounded-circle">
    </div>
    <div class="col-3">
        {{$post->body}}
        <br>
        <a href="{{route('show.post', $post->user->id)}}" class="btn btn-secondary">Show post</a>
    </div>
    <div>
    <div>
        {{$post->recommender->name}}
        {{$post->recommender->lastname}}
    </div>
    {{$post->recommender->email}}
    <form action="{{ route('delete.post', $post->id) }}" method="POST" class="mt-2">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">Delete</button>
  </form>
    </div>
   
    </div>



@endforeach
@endsection

