<!doctype html>
<html>
<head>
    <title>Sewage Truck Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .pending-balance { background-color: #fff3cd; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('dashboard') }}">Sewage Trucks</a>
    @auth
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('companies.index') }}">Companies</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('labours.index') }}">Labours</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('vehicles.index') }}">Vehicles</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('loads.index') }}">Loads</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('attendance.index') }}">Attendance</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('salary.index') }}">Salary</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('accounts.index') }}">Accounts</a></li>
      </ul>
      <span class="navbar-text me-3">
          {{ auth()->user()->name }} ({{ auth()->user()->role }})
      </span>
      <a href="{{ route('logout') }}" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
    @endauth
  </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mt-2">{{ session('error') }}</div>
    @endif

    @yield('content')
</div>
</body>
</html>
