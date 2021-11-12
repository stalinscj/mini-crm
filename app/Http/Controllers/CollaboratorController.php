<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Collaborator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\CollaboratorRequest;

class CollaboratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $collaborators = Collaborator::withTrashed()
            ->with('company')
            ->get();

        return view('collaborators.index', compact('collaborators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $collaborator = new Collaborator();
        $companies = Company::all();

        return view('collaborators.create', compact('collaborator', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CollaboratorRequest  $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CollaboratorRequest $request)
    {
        Collaborator::create($request->validated());

        Alert::toast('Colaborador creado exitosamente', 'success');

        return redirect()->route('collaborators.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collaborator  $collaborator
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Collaborator $collaborator)
    {
        return view('collaborators.show', compact('collaborator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collaborator  $collaborator
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Collaborator $collaborator)
    {
        $companies = Company::all();

        return view('collaborators.edit', compact('collaborator', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CollaboratorRequest  $request
     * @param  \App\Models\Collaborator  $collaborator
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CollaboratorRequest $request, Collaborator $collaborator)
    {
        $collaborator->update($request->validated());

        Alert::toast('Colaborador editado exitosamente', 'success');

        return redirect()->route('collaborators.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collaborator  $collaborator
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Collaborator $collaborator)
    {
        $collaborator->secureDelete();

        Alert::toast('Colaborador eliminado exitosamente', 'success');

        return redirect()->route('collaborators.index');
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
        Collaborator::withTrashed()
            ->where('id', $id)
            ->firstOrFail()
            ->restore();

        Alert::toast('Colaborador restaurado exitosamente', 'success');

        return redirect()->route('collaborators.index');
    }
}
