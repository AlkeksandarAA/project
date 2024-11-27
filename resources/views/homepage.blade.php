@extends('master.layout')

@section('content')
<div class="form-container">
    <h1 class="pb-5"><b>Најави се</b> или <b>Регистрирај се</b></h1>
<form action="{{route('login')}}" method="get">
    <button class="email-btn">
      Најави се
    </button>
</form>
    <div class="divider">
      <hr />
      <span>или</span>
      <hr />
    </div>
    <form action="{{route('register')}}" method="GET">
    <button class="email-btn" type="submit">Регистрирај се</button>
    </form>
</section>
@endsection