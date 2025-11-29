@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <h3 class="mb-3 text-center">Login (with OTP)</h3>
        <form method="POST" action="{{ route('login.sendOtp') }}">
            @csrf
            <div class="mb-3">
                <label>Email</label>
                <input name="email" type="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input name="password" type="password" class="form-control" required>
            </div>
            <button class="btn btn-primary w-100">Send OTP</button>
        </form>
    </div>
</div>
@endsection
