<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Labour;
use App\Models\Vehicle;
use App\Models\Load;

class DashboardController extends Controller
{
    public function index()
    {
        $companiesCount = Company::count();
        $laboursCount   = Labour::count();
        $vehiclesCount  = Vehicle::count();
        $todayLoads     = Load::whereDate('date', today())->count();

        return view('dashboard', compact(
            'companiesCount',
            'laboursCount',
            'vehiclesCount',
            'todayLoads'
        ));
    }
}
