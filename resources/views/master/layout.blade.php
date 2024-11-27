<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/52dd7732e0.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
          <div class="logo">
            <img src="{{asset('/images/Logo.png')}}" alt="Logo" />
          </div>
          <ul class="nav-links">
            @if(auth()->check() && (auth()->user()->role_id === 2 || auth()->user()->role_id === 3))
            <li><a href={{route('admin.dashboard')}}>Админ табла</a></li>
            @endif
            <li><a href="{{route('dashboard')}}">Твој Профил</a></li>
            <li><a href="{{route('all.conferences')}}">Годишна Конференција</a></li>
            <li><a href="{{route('all.events')}}">Настани</a></li>
            <li><a href="{{route('all.blogs')}}">Блог</a></li>
          </ul>
          <div class="nav-button">
            <i class="fa-regular fa-bell me-lg-3"></i>
            <span class="me-lg-3"> MK / EN</span>
            @if(!auth()->user())
            <a href="{{route('homepage')}}" class="button-link">Зачлени се</a>
            @else
            <a href="{{route('logout')}}" class="button-link">Одјави се</a>
          @endif
          </div>
        </div>
      </nav>
  

    @yield('content')
</body>
</html>