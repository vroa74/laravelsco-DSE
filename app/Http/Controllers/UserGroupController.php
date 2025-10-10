<?php

namespace App\Http\Controllers;

use App\Models\UserGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = UserGroup::with(['creator', 'members'])
                          ->active()
                          ->orderBy('name')
                          ->get();

        // Agregar estadísticas de archivos para cada grupo
        $groups->each(function ($group) {
            $group->files_stats = $group->files_statistics;
        });

        return view('user-groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user-groups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:user_groups,name',
            'description' => 'nullable|string',
            'active' => 'boolean',
        ]);

        $validated['created_by'] = Auth::id();
        $validated['active'] = $validated['active'] ?? true;

        $group = UserGroup::create($validated);

        return redirect()->route('user-groups.index')
                        ->with('success', 'Grupo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserGroup $userGroup)
    {
        $userGroup->load(['creator', 'members']);
        
        // Cargar estadísticas de archivos
        $filesStats = $userGroup->files_statistics;
        
        // Cargar documentos con archivos activos
        $documentsWithFiles = $userGroup->documentsWithActiveFiles()->paginate(10);

        return view('user-groups.show', compact('userGroup', 'filesStats', 'documentsWithFiles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserGroup $userGroup)
    {
        return view('user-groups.edit', compact('userGroup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserGroup $userGroup)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('user_groups', 'name')->ignore($userGroup->id)
            ],
            'description' => 'nullable|string',
            'active' => 'boolean',
        ]);

        $validated['active'] = $validated['active'] ?? true;

        $userGroup->update($validated);

        return redirect()->route('user-groups.index')
                        ->with('success', 'Grupo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserGroup $userGroup)
    {
        // Verificar si tiene miembros
        if ($userGroup->members()->count() > 0) {
            return redirect()->route('user-groups.index')
                           ->with('error', 'No se puede eliminar un grupo que tiene miembros.');
        }

        // Verificar si tiene reportes turnados
        if ($userGroup->cos()->count() > 0) {
            return redirect()->route('user-groups.index')
                           ->with('error', 'No se puede eliminar un grupo que tiene reportes turnados.');
        }

        $userGroup->delete();

        return redirect()->route('user-groups.index')
                        ->with('success', 'Grupo eliminado exitosamente.');
    }

    /**
     * Add member to group
     */
    public function addMember(Request $request, UserGroup $userGroup)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($validated['user_id']);

        // Verificar si el usuario ya pertenece a otro grupo
        if ($user->groups()->count() > 0) {
            return back()->with('error', 'El usuario ya pertenece a un grupo.');
        }

        $userGroup->addMember($user);

        return back()->with('success', 'Usuario agregado al grupo exitosamente.');
    }

    /**
     * Remove member from group
     */
    public function removeMember(Request $request, UserGroup $userGroup)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($validated['user_id']);
        $userGroup->removeMember($user);

        return back()->with('success', 'Usuario removido del grupo exitosamente.');
    }

    /**
     * Get users available for adding to group
     */
    public function getAvailableUsers(UserGroup $userGroup)
    {
        $availableUsers = User::whereDoesntHave('groups')
                             ->where('id', '!=', Auth::id())
                             ->select('id', 'name', 'email', 'position')
                             ->get();

        return response()->json($availableUsers);
    }
}