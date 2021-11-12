<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\CompanyRequest;
use RealRashid\SweetAlert\Facades\Alert;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $companies = Company::withTrashed()->get();

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $company = new Company();

        return view('companies.create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CompanyRequest  $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CompanyRequest $request)
    {
        Company::create($request->validated());

        Alert::toast('Empresa creada exitosamente', 'success');

        return redirect()->route('companies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CompanyRequest  $request
     * @param  \App\Models\Company  $company
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $company->update($request->validated());

        Alert::toast('Empresa editada exitosamente', 'success');

        return redirect()->route('companies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Company $company)
    {
        $company->secureDelete();

        Alert::toast('Empresa eliminada exitosamente', 'success');

        return redirect()->route('companies.index');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int $id
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $company = Company::withTrashed()->firstWhere('id', $id);
        $company->restore();

        Alert::toast('Empresa restaurada exitosamente', 'success');

        return redirect()->route('companies.index');
    }
}
