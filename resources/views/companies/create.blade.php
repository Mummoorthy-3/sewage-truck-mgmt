@extends('layouts.app')

@section('content')
<h2>Add Company</h2>
<form method="POST" action="{{ route('companies.store') }}">
@csrf
<div class="mb-3">
    <label>Name</label>
    <input name="name" class="form-control" required>
</div>
<div class="mb-3">
    <label>Phone</label>
    <input name="phone" class="form-control">
</div>
<div class="mb-3">
    <label>Address</label>
    <textarea name="address" class="form-control"></textarea>
</div>
<button class="btn btn-success">Save</button>
</form>
@endsection

