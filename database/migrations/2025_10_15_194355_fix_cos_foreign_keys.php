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
        Schema::table('cos', function (Blueprint $table) {
            // Eliminar la llave foránea incorrecta de rem_id
            $table->dropForeign(['rem_id']);
            
            // Agregar tur_id para cuando se selecciona un usuario individual
            $table->unsignedBigInteger('tur_id')->nullable()->after('tur_deporg');
            
            // Crear las llaves foráneas correctas
            $table->foreign('rem_id')->references('id')->on('ages')->onDelete('set null');
            $table->foreign('tur_id')->references('id')->on('users')->onDelete('set null');
            
            // Agregar índice para mejor rendimiento
            $table->index('tur_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cos', function (Blueprint $table) {
            // Eliminar llaves foráneas e índices
            $table->dropForeign(['rem_id']);
            $table->dropForeign(['tur_id']);
            $table->dropIndex(['tur_id']);
            
            // Eliminar columna agregada
            $table->dropColumn(['tur_id']);
            
            // Restaurar la llave foránea original de rem_id hacia users
            $table->foreign('rem_id')->references('id')->on('users')->onDelete('set null');
        });
    }
};
