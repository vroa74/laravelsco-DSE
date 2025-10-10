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
            // Agregar campos para soportar turnado a grupos
            $table->unsignedBigInteger('tur_group_id')->nullable()->after('rem_id'); // ID del grupo al que se turna
            $table->string('tur_type', 10)->default('user')->after('tur_group_id'); // Tipo de turnado: 'user' o 'group'
            
            // Llaves foráneas
            $table->foreign('tur_group_id')->references('id')->on('user_groups')->onDelete('set null');
            
            // Índices
            $table->index('tur_group_id');
            $table->index('tur_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cos', function (Blueprint $table) {
            // Eliminar llaves foráneas e índices
            $table->dropForeign(['tur_group_id']);
            $table->dropIndex(['tur_group_id']);
            $table->dropIndex(['tur_type']);
            
            // Eliminar columnas
            $table->dropColumn(['tur_group_id', 'tur_type']);
        });
    }
};
