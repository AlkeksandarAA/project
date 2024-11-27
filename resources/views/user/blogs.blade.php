

@extends('master.layout')

@section('content')
<div class="d-flex justify-content-end col-10 offset-1 mt-5 mb-4">
<a href="{{route('create.blog')}}" class="btn btn-primary">Create a new blog</a>
</div>
<div class="col-8 offset-2">
    <div class="row">
        @foreach($blogs as $blog)
                <div class="event me-2">
                    <img src="{{ asset('/images/sign-up-banner.jpg') }}" alt="Event 1" class="img-fluid" />
                    <div class="event-text">
                        <h3>{{ $blog->title }}</h3>
                        <p>{{ $blog->body }}</p>
                        <form action="{{ route('show.blog', $blog->id) }}">
                            <button type="submit" class="btn btn-primary">
                                Прочитај повеќе
                            </button>
                        </form>
                </div>
            </div>
        @endforeach
    </div>
</div>



@endsection

