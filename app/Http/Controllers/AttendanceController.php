<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Labour;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $labours = Labour::orderBy('name')->get();
        $date = request('date', now()->toDateString());

        $attendances = Attendance::where('date', $date)->get()->keyBy('labour_id');

        return view('attendance.index', compact('labours', 'date', 'attendances'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'labour_id' => 'required|array',
            'status' => 'required|array',
            'method' => 'required|array',
        ]);

        $date = $request->date;

        foreach ($request->labour_id as $index => $labourId) {
            Attendance::updateOrCreate(
                [
                    'labour_id' => $labourId,
                    'date' => $date,
                ],
                [
                    'status' => $request->status[$index],
                    'method' => $request->method[$index],
                ]
            );
        }

        return back()->with('success', 'Attendance saved successfully');
    }
}
