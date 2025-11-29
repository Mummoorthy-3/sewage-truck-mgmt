<?php

namespace App\Http\Controllers;

use App\Models\Load;
use App\Models\Company;
use App\Models\Vehicle;
use App\Models\Labour;
use App\Models\LabourLoad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoadController extends Controller
{
    public function index()
    {
        $loads = Load::with('company','vehicle')
            ->orderByDesc('date')
            ->paginate(20);

        return view('loads.index', compact('loads'));
    }

    public function create()
    {
        $companies = Company::orderBy('name')->get();
        $vehicles  = Vehicle::orderBy('name')->get();
        $labours   = Labour::orderBy('name')->get();

        return view('loads.create', compact('companies','vehicles','labours'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'company_id'    => 'required|exists:companies,id',
            'vehicle_id'    => 'required|exists:vehicles,id',
            'date'          => 'required|date',
            'rate_per_load' => 'required|numeric',
            'load_count'    => 'required|integer|min:1',
            'amount_paid'   => 'nullable|numeric',
            'labour_ids'    => 'array',
            'labour_ids.*'  => 'exists:labours,id',
            'loads_done.*'  => 'nullable|integer|min:0',
            'labour_rate.*' => 'nullable|numeric|min:0',
        ]);

        DB::transaction(function () use ($request, $data) {
            $totalAmount = $data['rate_per_load'] * $data['load_count'];

            $load = Load::create([
                'company_id'    => $data['company_id'],
                'vehicle_id'    => $data['vehicle_id'],
                'date'          => $data['date'],
                'rate_per_load' => $data['rate_per_load'],
                'load_count'    => $data['load_count'],
                'total_amount'  => $totalAmount,
                'amount_paid'   => $data['amount_paid'] ?? 0,
            ]);

            if ($request->labour_ids) {
                foreach ($request->labour_ids as $idx => $labourId) {
                    $ld = $request->loads_done[$idx] ?? 0;
                    $rt = $request->labour_rate[$idx] ?? 0;
                    if ($ld <= 0 || $rt <= 0) continue;

                    LabourLoad::create([
                        'labour_id'     => $labourId,
                        'load_id'       => $load->id,
                        'loads_done'    => $ld,
                        'rate_per_load' => $rt,
                        'amount'        => $ld * $rt,
                    ]);
                }
            }
        });

        return redirect()->route('loads.index')->with('success','Load saved');
    }

    public function edit(Load $load)
    {
        if ($load->isLocked()) {
            return back()->with('error','Entry locked after 2 days.');
        }

        $companies = Company::orderBy('name')->get();
        $vehicles  = Vehicle::orderBy('name')->get();

        return view('loads.edit', compact('load','companies','vehicles'));
    }

    public function update(Request $request, Load $load)
    {
        if ($load->isLocked()) {
            return back()->with('error','Entry locked after 2 days.');
        }

        $data = $request->validate([
            'company_id'    => 'required|exists:companies,id',
            'vehicle_id'    => 'required|exists:vehicles,id',
            'date'          => 'required|date',
            'rate_per_load' => 'required|numeric',
            'load_count'    => 'required|integer|min:1',
            'amount_paid'   => 'nullable|numeric',
        ]);

        $data['total_amount'] = $data['rate_per_load'] * $data['load_count'];

        $load->update($data);
        return redirect()->route('loads.index')->with('success','Load updated');
    }

    public function destroy(Load $load)
    {
        $load->delete();
        return back()->with('success','Load deleted');
    }
}
