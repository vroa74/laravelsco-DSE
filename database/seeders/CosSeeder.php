<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cos;
use App\Models\User;

class CosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener usuarios existentes
        $users = User::all();
        
        if ($users->isEmpty()) {
            $this->command->info('No hay usuarios en la base de datos. Creando datos de ejemplo sin relaciones.');
            return;
        }

        // Tipos de correspondencia
        $tiposCorrespondencia = ['Oficio', 'Carta', 'Memorándum', 'Circular', 'Acuerdo'];
        
        // Clasificaciones
        $clasificaciones = ['Urgente', 'Importante', 'Rutinario', 'Confidencial'];
        
        // Dependencias
        $dependencias = ['CONGRESO DEL ESTADO', 'GOBIERNO ESTATAL', 'MUNICIPIO', 'ORGANISMO AUTÓNOMO'];

        // Crear registros COS de ejemplo
        for ($i = 1; $i <= 50; $i++) {
            $user = $users->random(); // Usuario aleatorio como remitente
            
            Cos::create([
                'legislatura' => '2024-2027',
                'fcap' => now()->subDays(rand(1, 365)),
                'frec' => now()->subDays(rand(1, 30)),
                'ncor' => 'COS-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'tcor' => $tiposCorrespondencia[array_rand($tiposCorrespondencia)],
                'ccor' => $clasificaciones[array_rand($clasificaciones)],
                'fofi' => now()->subDays(rand(1, 60)),
                'nofi' => 'OF-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT),
                'nhoj' => rand(1, 10),
                'rem_nombre' => $user->name,
                'rem_cargo' => $user->position,
                'rem_deporg' => $user->direction,
                'rem_id' => $user->id, // ← Relación con usuario
                'rem_dir' => 'Dirección del remitente ' . $i,
                'des' => 'Descripción del documento ' . $i . ' - ' . fake()->sentence(),
                'seguimiento' => 'Seguimiento del documento ' . $i,
                'tur_nom' => $users->random()->name,
                'tur_cargo' => $users->random()->position,
                'tur_deporg' => $dependencias[array_rand($dependencias)],
                'creo' => $users->random()->id, // ← Usuario que creó
                'modifico' => $users->random()->id, // ← Usuario que modificó
                'reporte' => 'REP-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'estatus' => rand(0, 1) == 1, // Boolean aleatorio
            ]);
        }

        $this->command->info('Se crearon 50 registros COS de ejemplo con relaciones a usuarios.');
    }
}
