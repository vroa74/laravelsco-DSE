<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_group_members', function (Blueprint $table) {
            // Agregar constraint único para que un usuario solo pertenezca a un grupo
            // Primero eliminamos la restricción unique existente
            $table->dropUnique(['group_id', 'user_id']);
            
            // Agregamos nueva restricción que asegura que un usuario solo puede estar en un grupo
            $table->unique('user_id', 'unique_user_membership');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_group_members', function (Blueprint $table) {
            // Eliminar la restricción única de usuario
            $table->dropUnique('unique_user_membership');
            
            // Restaurar la restricción original
            $table->unique(['group_id', 'user_id']);
        });
    }
};
