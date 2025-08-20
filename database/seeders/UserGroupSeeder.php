<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserGroup;
use App\Models\User;

class UserGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear grupos de usuarios de ejemplo
        $grupos = [
            [
                'name' => 'Administradores',
                'description' => 'Grupo de administradores del sistema',
                'is_active' => true
            ],
            [
                'name' => 'Secretarios',
                'description' => 'Grupo de secretarios administrativos',
                'is_active' => true
            ],
            [
                'name' => 'Coordinadores',
                'description' => 'Grupo de coordinadores de área',
                'is_active' => true
            ],
            [
                'name' => 'Auxiliares',
                'description' => 'Grupo de auxiliares administrativos',
                'is_active' => true
            ]
        ];

        foreach ($grupos as $grupo) {
            UserGroup::create($grupo);
        }

        // Asignar usuarios existentes a grupos (opcional)
        $users = User::all();
        $userGroups = UserGroup::all();

        if ($users->count() > 0 && $userGroups->count() > 0) {
            // Asignar el primer usuario al grupo de administradores
            $adminGroup = $userGroups->where('name', 'Administradores')->first();
            if ($adminGroup && $users->first()) {
                $adminGroup->users()->attach($users->first()->id);
            }

            // Asignar algunos usuarios al grupo de secretarios
            $secretariosGroup = $userGroups->where('name', 'Secretarios')->first();
            if ($secretariosGroup && $users->count() > 1) {
                $secretariosGroup->users()->attach($users->skip(1)->take(2)->pluck('id'));
            }
        }
    }
}
