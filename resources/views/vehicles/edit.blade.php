@extends('layouts.app')

@section('content')
<h2>Edit Vehicle</h2>

<form method="POST" action="{{ route('vehicles.update',$vehicle) }}">
@csrf
@method('PUT')

<div class="mb-3">
    <label>Vehicle Name</label>
    <input name="name" class="form-control" value="{{ $vehicle->name }}" required>
</div>

<div class="mb-3">
    <label>Registration Number</label>
    <input name="registration_number" class="form-control" value="{{ $vehicle->registration_number }}" required>
</div>

<button class="btn btn-success">Update</button>
</form>
@endsection

