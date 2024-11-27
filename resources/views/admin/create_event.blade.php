@extends('master.layout')

@section('content')
<x-error></x-error>



<div class="col-8 offset-2 mt-4">
    <h2 class="text-center">Направете нов настан</h2>
<form action="{{ route('store.event')}}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Назив</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="about" class="form-label">Опис</label>
        <input type="text" class="form-control" id="about" name="about">
      </div>
      <div class="mb-3">
        <label for="date" class="form-label">Датму и Време</label>
        <input type="text" class="form-control" id="date" name="date" >
      </div>
      <div class="mb-3">
        <label for="ticket_price" class="form-label">Цена на карта</label>
        <input type="number" class="form-control" id="ticket_price" name="ticket_price" >
      </div>
      <div class="mb-3">
        <label for="theme" class="form-label">Тема</label>
        <input type="text" class="form-control" id="theme" name="theme" >
      </div>
      <div class="mb-3">
        <label for="location" class="form-label">Локација</label>
        <input type="text" class="form-control" id="location" name="location" >
      </div>
      <div class="mb-3">
          <label for="conference">Конференција</label>
          <input type="checkbox" name="conference" id="conference" value="1">
      </div>
      <button type="submit" class="btn btn-primary">Продолжи</button>
    </form>
</div>
    @endsection