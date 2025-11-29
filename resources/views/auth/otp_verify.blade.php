
@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <h3 class="mb-3 text-center">OTP Verification</h3>

       

        <form method="POST" action="{{ route('login.verifyOtp') }}">
            @csrf
            <div class="mb-3">
                <label>Enter OTP</label>
                <input name="code" class="form-control" required>
            </div>
            <button class="btn btn-success w-100">Verify & Login</button>
        </form>
    </div>
</div>
@endsection

