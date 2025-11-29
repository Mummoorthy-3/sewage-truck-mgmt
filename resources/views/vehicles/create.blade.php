@extends('layouts.app')

@section('content')
<h2>Add Vehicle</h2>

<form method="POST" action="{{ route('vehicles.store') }}">
@csrf
<div class="mb-3">
    <label>Vehicle Name</label>
    <input name="name" class="form-control" required>
</div>

<div class="mb-3">
    <label>Registration Number</label>
    <input name="registration_number" class="form-control" required>
</div>

<button class="btn btn-success">Save</button>
</form>
@endsection
