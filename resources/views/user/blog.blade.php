@extends('master.layout')

@section('content')
<x-error></x-error>
<div class="d-flex justify-content-between col-10 offset-1">
    <div>
        <h1>{{$blog->title}}</h1>
        <p>{{$blog->body}}</p>
        <form action="{{route('add.comment' , $blog->id)}}" method="POST">
            @csrf
        <textarea name="body" id="body" cols="30" rows="1" placeholder="Add a comment.."></textarea>
        <button type="submit" class="inline-block">Submit</button>
        </form> 
        <h2>Коментари</h2>
        @foreach($blog->comments as $comment)
        <div class="d-flex mb-3 ms-3">
        <img src="{{asset ($comment->user->img)}}" alt="pp" class="small-img me-2">
        <div>
        <h5>{{$comment->user->name}}</h5>
        <p>{{$comment->created_at}}</p>
    </div>
</div>
<p class="ms-5">{{$comment->body}}</p>
        <i class="fa-solid fa-thumbs-up"></i>  {{$comment->like()->sum('likes')}}
        <form action="{{ route('like.comment', ['user' => auth()->user()->id, 'comment' => $comment->id]) }}" method="POST">
            @csrf
                @php
                     $alreadyLiked = auth()->user()->commentLike()->where('comment_id' , $comment->id)->exists();
                @endphp
            @if(!$alreadyLiked)
        <button type="submit" class="btn bnt-sm">Like comment</button>
        @else 
        <button type="submit" class="btn bnt-sm" disabled>liked</button>
        @endif
        </form>
        <h6>коментари за коментаорт</h6>
        @foreach ($comment->replies->take(2) as $reply)
       
            <div class=" ms-5">
                <div class="d-flex ms-5 ">
                <img src="{{asset($reply->user->img ?? 'images/profile-image.jpg')}}" alt="" class='small-img'>
                <div class="ms-2">
                <h6 class="align-self-center ">{{ $reply->user ? $reply->user->name : 'Anonymous' }}</h6>
                <p>{{$reply->created_at}}</p>
            </div>
            </div>
            <div class="ms-5 ">
                 <p class="ms-5">{{ $reply->body }}</p>
            </div>
             </div>
        @endforeach
        @if(!$comment->replies->isEmpty())
        <div class="col-4 offset-2">
        <form action="{{ route('show.comment', ['comment' => $comment->id]) }}" method="GET" class="mb-4">
            <button class="btn bg-info" type="submit">Прикажи повеќе</button>
        </form>
    </div>
    @endif
    <form action="{{route('add.reply', $comment->id)}}" method="POST"  class="col-6 offset-2 d-flex">
        @csrf
        <textarea name="body" id="body" cols="30" rows="1" placeholder="Add a reply" class="me-2"></textarea>
        <button type="submit" class="btn btn-secondary" >Додади коментар</button>
    </form>
         @endforeach
    </div>
    <div>
        <img src="{{asset($blog->user->img)}}" alt="user pp">
        <p>{{$blog->user->name}}</p>
    </div>
  
@if (auth()->user()->role_id === 2 || auth()->user()->role_id === 3 || auth()->user()->id === $reply->user_id)
<form action="{{route('delete.blog', ['blog' => $blog->id])}}" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm bg-danger">Delete blog</button>
</form>
@endif
@if (auth()->user()->id === $blog->user_id)
<form action="{{route('edit.blog', ['blog' => $blog->id])}}" method="GET">
    @csrf
    <button class="btn" id="edit-{{$blog->id}}" type="submit">Edit</button>
</form>
@endif


<br>

</div>
 @endsection