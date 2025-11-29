@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Vehicles</h2>
    <a href="{{ route('vehicles.create') }}" class="btn btn-primary btn-sm">Add Vehicle</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Registration No</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vehicles as $vehicle)
        <tr>
            <td>{{ $vehicle->name }}</td>
            <td>{{ $vehicle->registration_number }}</td>
            <td>
                <a href="{{ route('vehicles.edit',$vehicle) }}" class="btn btn-sm btn-secondary">Edit</a>
                <form action="{{ route('vehicles.destroy',$vehicle) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
