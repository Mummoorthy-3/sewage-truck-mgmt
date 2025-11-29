@extends('layouts.app')

@section('content')
<h2 class="mb-3">Dashboard</h2>
<div class="row">
    <div class="col-md-3">
        <div class="card mb-3"><div class="card-body text-center">
            <h6>Companies</h6>
            <h3>{{ $companiesCount }}</h3>
        </div></div>
    </div>
    <div class="col-md-3">
        <div class="card mb-3"><div class="card-body text-center">
            <h6>Labours</h6>
            <h3>{{ $laboursCount }}</h3>
        </div></div>
    </div>
    <div class="col-md-3">
        <div class="card mb-3"><div class="card-body text-center">
            <h6>Vehicles</h6>
            <h3>{{ $vehiclesCount }}</h3>
        </div></div>
    </div>
    <div class="col-md-3">
        <div class="card mb-3"><div class="card-body text-center">
            <h6>Loads Today</h6>
            <h3>{{ $todayLoads }}</h3>
        </div></div>
    </div>
</div>
@endsection
