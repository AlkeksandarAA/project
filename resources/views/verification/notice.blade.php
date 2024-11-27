@extends('master.layout')

@section('content')
 

<div class="card">
    <div class="card-body">
        <p class="card-text fw-bolder">
            We have sent you a email with the verification link please check your email inbox and verify it
        </p>
        <p class="card-text fw-bolder">
            If you have not received it please click the link down below and we will send you a new one
        </p>
        <form action="">
            <button type="submit">
                Resend verification email
            </button>
        </form>
<p>
    Thank you
</p>

    </div>
</div>

@endsection