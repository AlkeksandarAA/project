@extends('master.layout')

@section('content')
<x-error></x-error>

<form action="{{route('store.blog')}}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="body" class="form-label">Text</label>
        <input type="text" class="form-control" id="body" name="body">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection