
@extends('master.layout')
<style>
  .hide {
    background-color: black;
    opacity: 0;
    position: fixed;
    right: 0;
    left: 0;
    bottom: 0;
    top: 0;
    transition: all 0.3s ease-in-out;
    z-index: -1;

    display: flex;
    align-items: center;
    justify-content: center;
  }
  .show {
    opacity: 0.95;
    z-index: 999;

  }
  .close {
    position: relative;
    top: 0;
    right: 0;
  }
</style>
@section('content')


<div id="update" class="hide">

  <div id="profile-form" class="hide">
    <button class="btn text-light close" id="close"><i class="fa-light fa-x"></i></button>
    <form action="{{route('update.user', auth()->user()->id)}}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label for="email" class="form-label text-light">Емаил аддреса</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label text-light">Лозинка</label>
        <input type="password" name="password" class="form-control" id="password">
      </div>
      <div class="mb-3">
        <label for="phone" class="form-label text-light">Телефонски број</label>
        <input type="tel"  id="phone" name="phone" class="form-control">
      </div>
      <div class="mb-3">
        <label for="postion" class="form-label text-light">Позиција</label>
        <input type="text"  id="postion" name="postion" class="form-control">
      </div>
      <button type="submit" class="btn btn-primary">Промени</button>
    </form>
   
  </div>
  <div id="address-form" class="hide">
    <button class="btn text-light close" id="close-address"><i class="fa-light fa-x"></i></button>
    <form action="{{route ('update.address', ['user' => $user->id])}}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label for="street" class="form-label text-light">Улица</label>
        <input type="text" class="form-control" id="street" name="street" aria-describedby="emailHelp" value = '{{$address->street}}'>
      </div>
      <div class="mb-3">
        <label for="city" class="form-label text-light">Град</label>
        <input type="text" name="city" class="form-control" id="city" value = '{{$address->city}}'>
      </div>
      <div class="mb-3">
        <label for="country" class="form-label text-light">Држава</label>
        <input type="text" class="form-control" id="country" name="country" aria-describedby="emailHelp" value = '{{$address->country}}'>
      </div>
      <div class="mb-3">
        <label for="postal_code" class="form-label text-light">Поштенски код</label>
        <input type="number" class="form-control" id="postal_code" name="postal_code" aria-describedby="emailHelp" value = '{{$address->postal_code}}'>
      </div>
      <button type="submit" class="btn btn-primary">Промени</button>
    </form>
  </div>
  <div id="bio-form" class="hide">
    <button class="btn text-light close" id="close-address"><i class="fa-light fa-x"></i></button>
    <form action="{{route('update.biography', ['user' => $user->id])}}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label for="title" class="form-label text-light">Назив</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" value = '{{$biography->title}}'>
      </div>
      <div class="mb-3">
        <label for="biography" class="form-label text-light">Опис</label>
        <input type="text" class="form-control" id="biography" name="biography" value = '{{$biography->biography}}'> 
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
  <div id="buttons">
  <button class="btn bg-info" id="profile"><strong>Промени профил</strong></button>
  <button class="btn bg-info" id="address"><strong>Промени аддреса</strong></button>
  <button class="btn bg-info" id="bio"><strong>Промени опис</strong></button>
  </div>
  <button type="button" class="btn text-light close"><i class="fa-light fa-x"></i></button>
</div>
@foreach (auth()->user()->notifications as $notification)
  <div>
    <p>{{ $notification->data['message'] }}</p>
    
    <form action="{{ route('accept.friend', $notification->id) }}" method="POST" style="display:inline;">
      @csrf
      <button type="submit">Accept</button>
    </form>
    
    <form action="{{ route('reject.friend', $notification->id) }}" method="POST" style="display:inline;">
      @csrf
      <button type="submit">Reject</button>
    </form>
  </div>
@endforeach
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
        <p>{{$address->city}}</p>
        <p>{{$address->country}}</p> 
      </div>
    </div>
    <div class="profile-details">
      <ul>
        <hr />
        <li><i class="fas fa-user"></i> HR регрутер</li>
        <li>
          <a href="#"><i class="fa-regular fa-file"></i> {{$resume->file_path}}</a>
        </li>
        <hr />
        <li><i class="fa-solid fa-user-plus"></i> {{$user->phone}}</li>
        <li>
          <i class="fa-regular fa-envelope"></i> {{$user->email}}
        </li>
        <li>
          <button id="openPopup" type="button"
          class="btn"  ><i class="fas fa-cog"></i> Поставки
          </button>
        </li>
      </ul>
    </div>
  </div>
  <div class="info-section bl-color">
    <h3>{{$biography->title}}</h3>
    <p class="pt-5">
      {{$biography->biography}}
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
        <p class="pt-4">
          {{$post->body}}
        </p>
        @endforeach
      </div>
    </div>
  </div>
</div>
@if($user->hasBadge(App\Badges\FirstLike::class))
<div class="user-overlay2">
  <div class="header-container">
    <h3>Најнови беџови</h3>
    <a href="#" class="user-link-text">Види ги сите</a>
  </div>
  <div class="badge-container mt-5">
    <div class="user-badge1">
      <i class="fa-regular fa-comment"></i>
    </div>
    <div class="badge-notification">
        <p>Congratulations! You've been awarded the Like badge!</p>
    </div>
  </div>
</div>
</div>
@endif
<div class="user-overlay2">
  <h3>Листа на конекции</h3>
  <div class="user-link-container pt-3">
    <a href="{{route('all.friends' , ['user' => $user->id])}}" class="user-link-text">Види ги сите</a>
  </div>
  <div class="user-image-container">

    <div class="user-image-row row">
      @foreach ($friends as $friend)
              <div class="user-image-item col-12 col-sm-6 col-md-4 mb-3"> 
                  <div style="display:inline;">
                      <form action="{{ route('show.user', $friend->id) }}" method="GET">
                          <button type="submit" class="btn btn-sm">
                              <img src="{{ asset($friend->img) }}" alt="User Image">
                              <p>{{ $friend->name }} {{ $friend->lastname }}</p>
                          </button>
                      </form>
                      <form action="{{ route('unfriend.user', $friend->id) }}" method="POST">
                          @csrf
                          <button type="submit" class="btn bg-danger">Unfriend</button>
                      </form>
                  </div>
              </div>
      @endforeach
  </div>
  
  </div>
</div>

@endsection
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Open the update panel
    document.querySelector('#openPopup').addEventListener('click', function() {
      document.querySelector('#update').classList.toggle('show');
    });


    document.querySelector('#profile').addEventListener('click', function() {
      document.querySelector('#profile-form').classList.toggle('show');
      document.querySelector('#buttons').classList.add('hide');
    });


    document.querySelector('#address').addEventListener('click', function() {
      // Show the address form, hide others
      document.querySelector('#address-form').classList.toggle('show');
      document.querySelector('#buttons').classList.add('hide');
    });


    document.querySelector('#bio').addEventListener('click', function() {

      document.querySelector('#bio-form').classList.toggle('show');
      document.querySelector('#buttons').classList.add('hide');
    });


    document.querySelectorAll('.close').forEach(button => {
      button.addEventListener('click', function() {
        button.parentElement.classList.remove('show');
        document.querySelector('#buttons').classList.remove('hide'); 
      });
    });
  });
</script>
