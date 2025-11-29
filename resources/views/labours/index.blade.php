@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Labours</h2>
    <a href="{{ route('labours.create') }}" class="btn btn-primary btn-sm">Add Labour</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Aadhaar</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($labours as $labour)
        <tr>
            <td>{{ $labour->name }}</td>
            <td>{{ $labour->phone }}</td>
            <td>{{ $labour->aadhaar_number }}</td>
            <td>
                <a href="{{ route('labours.edit',$labour) }}" class="btn btn-sm btn-secondary">Edit</a>
                <form action="{{ route('labours.destroy',$labour) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
