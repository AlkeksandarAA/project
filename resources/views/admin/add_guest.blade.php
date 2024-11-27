@extends('master.layout')

@section('content')
<div class="col-8 offset-2 mt-4">
<form action="{{ route ('store.guest' , ['event' => $event->id]) }}" method="POST">  
    @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Име на гостин</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="mb-3">
            <label for="about" class="form-label">Опис на гостин</label>
            <input type="text" class="form-control" id="about" name="about">
          </div>
       <button class="btn btn-primary" type="submit">Додај гостин</button>
  </form>
</div>
@endsection
