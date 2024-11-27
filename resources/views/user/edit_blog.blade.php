@extends('master.layout')

@section('content')
<x-error></x-error>

<h2>Edit blog: {{$blog->title}} </h2>

<form action="{{route('update.blog', ['blog' => $blog->id])}}" method="POST">
    @method('PUT')
    @csrf
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" value=" {{ $blog->title ?? '' }}">
      </div>
      <div class="mb-3">
        <label for="body" class="form-label">Text</label>
        <input type="text" class="form-control" id="body" name="body" value="{{ $blog->body ?? '' }}">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection