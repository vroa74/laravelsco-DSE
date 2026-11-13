<?php

namespace App\Http\Controllers;

use App\Models\Co;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RgController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Co::class);

        return view('rg.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Co::class);

        return view('rg.create');
    }

    /**
     * Store a newly created resource in storage.
     * DESHABILITADO - Se usa Livewire para manejar la creación
     */
    /*
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'legislatura' => 'required|string|max:255',
            'fcap' => 'required|date',
            'des' => 'required|string',
            'rem_nombre' => 'required|string|max:255',
            'rem_cargo' => 'nullable|string|max:255',
            'rem_deporg' => 'nullable|string|max:255',
        ]);

        // Crear nuevo registro
        $co = Co::create($request->all());

        return redirect()->route('rg.index')
            ->with('success', 'Registro creado exitosamente.');
    }
    */

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $co = Co::visibleTo(auth()->user())->findOrFail($id);

        return view('rg.show', compact('co'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('update', Co::findOrFail($id));

        return view('rg.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     * DESHABILITADO - Se usa Livewire para manejar la actualización
     */
    /*
    public function update(Request $request, string $id)
    {
        // Validación de datos
        $request->validate([
            'legislatura' => 'required|string|max:255',
            'fcap' => 'required|date',
            'des' => 'required|string',
            'rem_nombre' => 'required|string|max:255',
            'rem_cargo' => 'nullable|string|max:255',
            'rem_deporg' => 'nullable|string|max:255',
        ]);

        // Actualizar registro
        $co = Co::findOrFail($id);
        $co->update($request->all());

        return redirect()->route('rg.index')
            ->with('success', 'Registro actualizado exitosamente.');
    }
    */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $co = Co::findOrFail($id);
        Gate::authorize('delete', $co);
        $co->delete();

        return redirect()->route('rg.index')
            ->with('success', 'Registro eliminado exitosamente.');
    }
}
