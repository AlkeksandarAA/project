@extends('master.layout')
<style>
    .hidden {
        display: none;
    }
        </style>

@section('content')
<div class="col-8 offset-2 text-start mt-4">
    <div class="d-flex mb-3">
    <img  src="{{ asset($comment->user->img)}}" alt="" class="small-img me-3" >
    <h2>{{$comment->user->name}} {{$comment->user->lastname}}</h2>
</div>
<p>{{$comment->body}}</p>
{{$comment->totalLikes()}}
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
@foreach($comment->replies as $reply)
<div class="d-flex ms-4 mb-3">
<img src="{{asset($reply->user->img)}}" alt="userpp" class='small-img'>
<p class="align-self-center ms-3">{{$reply->user->name}} {{$reply->user->lastname}}</p>
</div>
<div class="ms-5">
    <blockquote class="ms-5">{{$reply->body}}</blockquote>
</div>
    @if (auth()->user()->role_id === 2 || auth()->user()->role_id === 3 || auth()->user()->id === $reply->user_id)
    <form action="{{route('delete.reply', ['reply' => $reply->id])}}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm bg-danger">Избриши коемнтар</button>
    </form>
    @endif
    @if (auth()->user()->id === $reply->user_id)
    <form action="{{route('edit.reply', $reply->id)}}" method="POST">
        @csrf
        @method('PATCH')
        <button class="btn" id="edit-{{$reply->id}}" type="button">Edit</button>
        <div class="hidden" id="edit-area-{{$reply->id}}">
        <textarea name="body" id="body" cols="30" rows="1">{{ $reply->body ?? '' }}</textarea>
        <button type="submit" class="btn">Submit</button>
    </div>
    </form>
  @endif
@endforeach
<x-error></x-error>
    <form action="{{route('add.reply', $comment->id)}}" method="POST">
        @csrf
        <textarea name="body" id="body" cols="30" rows="1" placeholder="Add a reply"></textarea>
        <button type="submit" class="bnt-sm">Додади коментар</button>
    </form>
</div>
@endsection


<script>
   document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('button[id^="edit-"]').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const replyId = this.id.split('-')[1];
                const editArea = document.querySelector(`#edit-area-${replyId}`);
                editArea.classList.toggle('hidden');
            });
        });
    });
</script>