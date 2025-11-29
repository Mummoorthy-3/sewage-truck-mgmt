<?php

namespace App\Http\Controllers;

use App\Models\Labour;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    // Show all salaries
    public function index()
    {
        $salaries = Salary::with('labour')->latest()->paginate(20);
        return view('salary.index', compact('salaries'));
    }

    // Generate salary for a month
    public function generate(Request $request)
    {
        $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year'  => 'required|integer|min:2000',
        ]);

        $month = $request->month;
        $year  = $request->year;

        DB::transaction(function () use ($month, $year) {

            $labours = Labour::with(['attendances', 'labourLoads.load', 'advances', 'extraIncomes'])->get();

            foreach ($labours as $labour) {

                // 1️⃣ Attendance count
                $attendanceDays = $labour->attendances
                    ->where('date', '>=', "$year-$month-01")
                    ->where('date', '<=', "$year-$month-31")
                    ->where('status', 'present')
                    ->count();

                // 2️⃣ Load income
                $loadIncome = $labour->labourLoads
                    ->filter(function ($ll) use ($month, $year) {
                        return $ll->load &&
                               $ll->load->date->month == $month &&
                               $ll->load->date->year == $year;
                    })
                    ->sum('amount');

                // 3️⃣ Extra income
                $extraIncome = $labour->extraIncomes
                    ->where('date', '>=', "$year-$month-01")
                    ->where('date', '<=', "$year-$month-31")
                    ->sum('amount');

                // 4️⃣ Advances
                $totalAdvances = $labour->advances
                    ->where('date', '>=', "$year-$month-01")
                    ->where('date', '<=', "$year-$month-31")
                    ->sum('amount');

                // 5️⃣ Salary Calculation
                $gross = $loadIncome + $extraIncome;
                $net   = $gross - $totalAdvances;

                // 6️⃣ Store salary
                Salary::updateOrCreate(
                    [
                        'labour_id' => $labour->id,
                        'month' => $month,
                        'year'  => $year,
                    ],
                    [
                        'attendance_days' => $attendanceDays,
                        'total_load_income' => $loadIncome,
                        'total_extra_income' => $extraIncome,
                        'total_advances' => $totalAdvances,
                        'gross_salary' => $gross,
                        'net_salary' => $net,
                    ]
                );
            }
        });

        return redirect()->route('salary.index')->with('success', 'Salary Generated Successfully!');
    }
}
