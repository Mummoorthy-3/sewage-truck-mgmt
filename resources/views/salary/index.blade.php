@extends('layouts.app')

@section('content')
<h2>Salary Module</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<!-- Salary Generator -->
<form action="{{ route('salary.generate') }}" method="POST" class="row g-3 mb-4">
    @csrf
    <div class="col-md-3">
        <label>Month</label>
        <input type="number" name="month" class="form-control" min="1" max="12" required>
    </div>

    <div class="col-md-3">
        <label>Year</label>
        <input type="number" name="year" class="form-control" min="2000" required>
    </div>

    <div class="col-md-3 mt-4">
        <button class="btn btn-success mt-2">Generate Salary</button>
    </div>
</form>

<!-- Salary Table -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Labour</th>
            <th>Month</th>
            <th>Attendance</th>
            <th>Load Income</th>
            <th>Extra Income</th>
            <th>Advances</th>
            <th>Gross Salary</th>
            <th>Net Salary</th>
        </tr>
    </thead>
    <tbody>
        @foreach($salaries as $salary)
        <tr>
            <td>{{ $salary->labour->name }}</td>
            <td>{{ $salary->month }}/{{ $salary->year }}</td>
            <td>{{ $salary->attendance_days }}</td>
            <td>{{ $salary->total_load_income }}</td>
            <td>{{ $salary->total_extra_income }}</td>
            <td>{{ $salary->total_advances }}</td>
            <td>{{ $salary->gross_salary }}</td>
            <td>{{ $salary->net_salary }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $salaries->links() }}
@endsection
