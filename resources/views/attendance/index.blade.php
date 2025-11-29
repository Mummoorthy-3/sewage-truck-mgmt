@extends('layouts.app')

@section('content')
<h2 class="mb-3">Labour Attendance</h2>

<form method="GET" class="mb-3">
    <label>Select Date:</label>
    <input type="date" name="date" value="{{ $date }}" class="form-control w-25 d-inline">
    <button class="btn btn-secondary btn-sm">Load</button>
</form>

<form method="POST" action="{{ route('attendance.store') }}">
@csrf
<input type="hidden" name="date" value="{{ $date }}">

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Labour</th>
            <th>Status</th>
            <th>Method</th>
        </tr>
    </thead>
    <tbody>
        @foreach($labours as $labour)
        @php
            $att = $attendances[$labour->id] ?? null;
        @endphp
        <tr>
            <td>
                {{ $labour->name }}
                <input type="hidden" name="labour_id[]" value="{{ $labour->id }}">
            </td>
            <td>
                <select name="status[]" class="form-select">
                    <option value="present" {{ $att && $att->status == 'present' ? 'selected' : '' }}>Present</option>
                    <option value="absent" {{ $att && $att->status == 'absent' ? 'selected' : '' }}>Absent</option>
                </select>
            </td>
            <td>
                <select name="method[]" class="form-select">
                    <option value="manual" {{ $att && $att->method == 'manual' ? 'selected' : '' }}>Manual</option>
                    <option value="biometric" {{ $att && $att->method == 'biometric' ? 'selected' : '' }}>Biometric</option>
                    <option value="barcode" {{ $att && $att->method == 'barcode' ? 'selected' : '' }}>Barcode</option>
                </select>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<button class="btn btn-success">Save Attendance</button>
</form>
@endsection
