<?php

namespace App\Http\Controllers;

use App\Models\Labour;
use Illuminate\Http\Request;

class LabourController extends Controller
{
    public function index()
    {
        $labours = Labour::latest()->paginate(20);
        return view('labours.index', compact('labours'));
    }

    public function create()
    {
        return view('labours.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'aadhaar_number' => 'required|string|max:20',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
        ]);

        Labour::create($data);

        return redirect()->route('labours.index')->with('success', 'Labour added successfully');
    }

    public function edit(Labour $labour)
    {
        return view('labours.edit', compact('labour'));
    }

    public function update(Request $request, Labour $labour)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'aadhaar_number' => 'required|string|max:20',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
        ]);

        $labour->update($data);

        return redirect()->route('labours.index')->with('success', 'Labour updated successfully');
    }

    public function destroy(Labour $labour)
    {
        $labour->delete();
        return back()->with('success', 'Labour deleted');
    }
}
