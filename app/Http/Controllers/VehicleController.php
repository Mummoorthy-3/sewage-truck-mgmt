<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::latest()->paginate(20);
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => 'required|string|max:100|unique:vehicles,registration_number',
        ]);

        Vehicle::create($data);

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehicle added successfully');
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => 'required|string|max:100|unique:vehicles,registration_number,' . $vehicle->id,
        ]);

        $vehicle->update($data);

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehicle updated successfully');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return back()->with('success', 'Vehicle deleted successfully');
    }
}
