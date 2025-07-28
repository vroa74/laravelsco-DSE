<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('age.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('age.create');
    }

    /**
     * Store a newly created resource in storage.
     * DESHABILITADO - Se usa Livewire para manejar la creación
     */
    /*
    public function store(Request $request)
    {
        //
    }
    */

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('age.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('age.edit');
    }

    /**
     * Update the specified resource in storage.
     * DESHABILITADO - Se usa Livewire para manejar la actualización
     */
    /*
    public function update(Request $request, string $id)
    {
        //
    }
    */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return view('age.destroy');
    }
}
