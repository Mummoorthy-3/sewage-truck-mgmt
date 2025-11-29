<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::latest()->paginate(20);
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required',
            'phone'   => 'nullable',
            'address' => 'nullable',
        ]);

        Company::create($data);
        return redirect()->route('companies.index')->with('success','Company created');
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $data = $request->validate([
            'name'    => 'required',
            'phone'   => 'nullable',
            'address' => 'nullable',
        ]);

        $company->update($data);
        return redirect()->route('companies.index')->with('success','Company updated');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return back()->with('success','Company deleted');
    }
}
