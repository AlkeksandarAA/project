@extends('master.layout')

@section('content')


<form action="{{ route ('store.detail')}}" method="POST">
    @csrf
    <x-error></x-error>
    <div class="mb-3">
    <label for="resume">Upload your resume</label>
    <br>
    <input type="file" name="file_path" id="file_path">
</div>
<h2>Where are you living</h2>
    <div class="mb-3">
        <label for="street" class="form-label">Street</label>
        <input type="text" class="form-control" id="street"  name="street" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="city" class="form-label">City</label>
        <input type="text" class="form-control" id="city"  name="city" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="postal_code" class="form-label">Post Code</label>
        <input type="text" class="form-control" id="postal_code"  name="postal_code" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="country" class="form-label">Country</label>
        <input type="text" class="form-control" id="country"  name="country" aria-describedby="emailHelp">
      </div>
      <h2>Tell us a little something about yourself</h2>
      <div class="mb-3">
        <input type="text" class="form-control" id="title"  name="title" placeholder="title for your Biograpy" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <textarea name="biography" id="biography" cols="50" rows="5" placeholder="biography..."></textarea>
      </div>
      <button type="Submit">Submit</button>
</form>



@endsection