@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Loads</h2>
    <a href="{{ route('loads.create') }}" class="btn btn-primary btn-sm">Add Load</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Date</th>
            <th>Company</th>
            <th>Vehicle</th>
            <th>Loads</th>
            <th>Rate</th>
            <th>Total</th>
            <th>Paid</th>
            <th>Balance</th>
            <th>Locked?</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($loads as $load)
        @php
            $balance = $load->balance();
            $rowClass = $balance > 0 ? 'pending-balance' : '';
        @endphp
        <tr class="{{ $rowClass }}">
            <td>{{ $load->date->format('d-m-Y') }}</td>
            <td>{{ $load->company->name }}</td>
            <td>{{ $load->vehicle->name }}</td>
            <td>{{ $load->load_count }}</td>
            <td>{{ $load->rate_per_load }}</td>
            <td>{{ $load->total_amount }}</td>
            <td>{{ $load->amount_paid }}</td>
            <td>{{ $balance }}</td>
            <td>{{ $load->isLocked() ? 'Yes' : 'No' }}</td>
            <td>
                <a href="{{ route('loads.edit',$load) }}" class="btn btn-sm btn-secondary">Edit</a>
                <form action="{{ route('loads.destroy',$load) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Delete?')" class="btn btn-sm btn-danger">Del</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $loads->links() }}
@endsection
