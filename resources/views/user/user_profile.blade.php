@php
   $isFriend = auth()->user()->friends()->where('friend_id', $user->id)->exists();
@endphp
<style>
  .hide {
    display: none;
  }
  .show {
    display: block;
  }
</style>
@extends('master.layout')

@section('content')

<div class="dashboard-container pt-5 pb-5">
  <div class="profile-section">
    <div class="profile-header">
      <div class="profile-image-container">
        <img src="{{ asset($user->img) }}" alt="User Image" />
        <div class="icon-overlay">
          <i class="fa-regular fa-comments"></i>
        </div>
      </div>
      <div class="profile-info">
        <p>{{$user->name}} {{$user->lastname}} </p>
        <p>{{$user->address->city}}</p>
        <p>{{$user->address->country}}</p> 
      </div>
      @if(auth()->user()->role_id === 3)
    @if($user->role_id === 1) 
        <form action="{{ route('update.admin', ['user' => $user->id]) }}" method="POST" id="makeAdmin">
            @method('PATCH')
            @csrf
            <input type="hidden" value="make" name="action">
            <button type="submit" class="btn btn-success">Make Admin</button>
        </form>
    @elseif($user->role_id === 2) 
        <form action="{{ route('update.admin', ['user' => $user->id]) }}" method="POST" id="removeAdmin">
            @method('PATCH')
            @csrf
            <input type="hidden" value="remove" name="action">
            <button type="submit" class="btn btn-warning">Remove Admin</button>
        </form>
    @endif
@endif
<div class="mt-2">
  @if(!$isFriend)
  <form action="{{ route('add.friend' , $user->id)}}" method="POST">
    @csrf
      <button type="submit" class="btn btn-secondary">Add friend</button>
  </form>
  @else 
    <p>You are already friends</p>
  @endif
</div>
    </div>
    <div class="profile-details">
      <ul>
        <hr />
        <li><i class="fas fa-user"></i> HR регрутер</li>
        <li>
          <a href="#"><i class="fa-regular fa-file"></i> {{$user->resume->file_path}}</a>
        </li>
        <hr />
        <li><i class="fa-solid fa-user-plus"></i> {{$user->phone}}</li>
        <li>
          <i class="fa-regular fa-envelope"></i> 
          {{$user->email}}
        </li>
        <li>
        </li>
      </ul>
    </div>
  </div>
  <div class="info-section bl-color">
    <h3>{{$user->bio->title}}</h3>
    <p class="pt-5">
      {{$user->bio->biography}}
    </p>
    <h3 class="pt-5">Препораки</h3>
    <div class="recommendations pt-3">
      <div class="recommendation">

        @foreach($posts as $post)
       
        <div class="image-and-text">
          <img src="{{asset ($post->recommender->img)}}" alt="Frano" />
          <div class="recommendation-text">
            <p><strong>{{$post->recommender->name}}</strong></p>
            <span>{{$post->created_at}}</span>
          </div>
        </div>
        <div>
        <p class="pt-4">
          {{$post->body}}
        </p>
      </div>
        @if(auth()->user()->id === $post->recommender->id || auth()->user()->role_id === 2 || auth()->user()->role_id === 3)
        <div class="mb-4 d-flex">
          <form action="{{ route('delete.post', $post->id) }}" method="POST" class="me-2">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
      </form>
      @endif
      @if(auth()->user()->id === $post->recommender->id )
      <form action="{{route('edit.post', $post->id)}}" method="POST">
        @csrf
        @method('PATCH')
        <button type="button" class="btn btn-info" id="updatePost">Edit post</button>
        <div class="hide mt-2" id="updated">
          <div>
          <textarea name="body" id="body" cols="30" rows="1"> {{$post->body}}</textarea>
          <br>
          <button type="submit" class="btn btn-info mt-2">Update</button>
          
          </div> 
        </div>
      </form>
      @endif
      </div>
        @endforeach
      </div>
    </div>
    <form action="{{ route('add.recommendation', ['user' => $user->id]) }}" method="POST" class="d-flex justify-content-between">
      @csrf
      <div class="hide" id = 'createPost'>
        <textarea name="body" id="body" cols="30" rows="1" placeholder="Додди препорака"></textarea>
        <br>
        <button type="submit" class="mt-2 btn btn-secondary">Додади</button>
      </div>
    <button type="button" class="btn btn-success" id="addPost" class="aling-self-end">Додади препорака</button>
    </form>
  </div>
</div>

@endsection

<script>
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('#addPost').addEventListener('click', () => {
      document.querySelector('#createPost').classList.toggle('show');
    });
    document.querySelector('#updatePost').addEventListener('click', () => { 
      document.querySelector('#updated').classList.toggle('show');
    })
  });
</script>