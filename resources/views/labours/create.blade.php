@extends('layouts.app')

@section('content')
<h2>Add Labour</h2>
<form method="POST" action="{{ route('labours.store') }}">
@csrf
<div class="mb-3">
    <label>Name</label>
    <input name="name" class="form-control" required>
</div>
<div class="mb-3">
    <label>Phone</label>
    <input name="phone" class="form-control" required>
</div>
<div class="mb-3">
    <label>Address</label>
    <textarea name="address" class="form-control"></textarea>
</div>
<div class="mb-3">
    <label>Aadhaar Number</label>
    <input name="aadhaar_number" class="form-control" required>
</div>
<div class="mb-3">
    <label>Emergency Contact Name</label>
    <input name="emergency_contact_name" class="form-control">
</div>
<div class="mb-3">
    <label>Emergency Contact Phone</label>
    <input name="emergency_contact_phone" class="form-control">
</div>
<button class="btn btn-success">Save</button>
</form>
@endsection
