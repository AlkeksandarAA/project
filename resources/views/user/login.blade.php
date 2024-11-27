@extends('master.layout')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center vh-100 mt-n1">
  <form action="{{ route('login.user') }}" method="POST" class="w-50 d-flex flex-column">
      @csrf
      <div class="mb-3">
          <label for="email" class="form-label">Емаил Адреса</label>
          <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
          <label for="password" class="form-label">Лозинка</label>
          <input type="password" class="form-control" name="password" id="password">
      </div>
      <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" name="remember" id="remember">
          <label class="form-check-label" for="remember">Запамети ме</label>
      </div>
      <button type="submit" class="btn btn-primary btn-sm">Логирај се</button>
  </form>
</div>
  @endsection