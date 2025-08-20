<?php

namespace App\Http\Controllers;

use App\Models\UserGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userGroups = UserGroup::with('users')->get();
        return view('user-groups.index', compact('userGroups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('status', true)->get();
        return view('user-groups.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:user_groups',
            'description' => 'nullable|string',
            'user_ids' => 'nullable|array',
            'user_ids.*' => 'exists:users,id'
        ]);

        DB::transaction(function () use ($request) {
            $userGroup = UserGroup::create([
                'name' => $request->name,
                'description' => $request->description,
                'is_active' => true
            ]);

            if ($request->has('user_ids')) {
                $userGroup->users()->attach($request->user_ids);
            }
        });

        return redirect()->route('user-groups.index')
                        ->with('success', 'Grupo de usuarios creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserGroup $userGroup)
    {
        $userGroup->load('users');
        return view('user-groups.show', compact('userGroup'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserGroup $userGroup)
    {
        $users = User::where('status', true)->get();
        $selectedUserIds = $userGroup->users->pluck('id')->toArray();
        return view('user-groups.edit', compact('userGroup', 'users', 'selectedUserIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserGroup $userGroup)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:user_groups,name,' . $userGroup->id,
            'description' => 'nullable|string',
            'user_ids' => 'nullable|array',
            'user_ids.*' => 'exists:users,id',
            'is_active' => 'boolean'
        ]);

        DB::transaction(function () use ($request, $userGroup) {
            $userGroup->update([
                'name' => $request->name,
                'description' => $request->description,
                'is_active' => $request->has('is_active')
            ]);

            // Sincronizar usuarios
            $userIds = $request->user_ids ?? [];
            $userGroup->users()->sync($userIds);
        });

        return redirect()->route('user-groups.index')
                        ->with('success', 'Grupo de usuarios actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserGroup $userGroup)
    {
        // Verificar si el grupo está siendo usado en correspondencias
        if ($userGroup->correspondencias()->count() > 0) {
            return back()->with('error', 'No se puede eliminar el grupo porque está siendo usado en correspondencias.');
        }

        $userGroup->users()->detach();
        $userGroup->delete();

        return redirect()->route('user-groups.index')
                        ->with('success', 'Grupo de usuarios eliminado exitosamente.');
    }

    /**
     * API endpoint para obtener grupos activos
     */
    public function getActiveGroups()
    {
        $groups = UserGroup::active()->with('users')->get();
        return response()->json($groups);
    }

    /**
     * API endpoint para obtener usuarios de un grupo
     */
    public function getGroupUsers(UserGroup $userGroup)
    {
        $users = $userGroup->users;
        return response()->json($users);
    }
}
