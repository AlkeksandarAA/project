@extends('master.layout')

@section('content')

@foreach($blogs as $blog)

<h2>{{$blog->title}}</h2>
<p>{{$blog->body}}</p>
<p>{{$blog->created_at}}</p>

<a href="{{route('show.blog', $blog->id )}}">Show More</a>

@endforeach
@endsection