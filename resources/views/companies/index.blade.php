@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Companies</h2>
    <a href="{{ route('companies.create') }}" class="btn btn-primary btn-sm">Add Company</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th><th>Phone</th><th>Address</th><th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($companies as $c)
        <tr>
            <td>{{ $c->name }}</td>
            <td>{{ $c->phone }}</td>
            <td>{{ $c->address }}</td>
            <td>
                <a href="{{ route('companies.edit',$c) }}" class="btn btn-sm btn-secondary">Edit</a>
                <form action="{{ route('companies.destroy',$c) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Delete?')" class="btn btn-sm btn-danger">Del</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $companies->links() }}
@endsection
