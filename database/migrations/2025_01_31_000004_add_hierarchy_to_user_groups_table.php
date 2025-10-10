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
        Schema::table('user_groups', function (Blueprint $table) {
            // Agregar campos para jerarquía
            $table->unsignedBigInteger('parent_id')->nullable()->after('created_by'); // Grupo padre
            $table->integer('level')->default(0)->after('parent_id'); // Nivel en la jerarquía
            $table->string('path', 500)->nullable()->after('level'); // Ruta completa en la jerarquía (ej: "1/2/3")
            $table->integer('sort_order')->default(0)->after('path'); // Orden de visualización
            
            // Llaves foráneas
            $table->foreign('parent_id')->references('id')->on('user_groups')->onDelete('set null');
            
            // Índices
            $table->index('parent_id');
            $table->index('level');
            $table->index('path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_groups', function (Blueprint $table) {
            // Eliminar llaves foráneas e índices
            $table->dropForeign(['parent_id']);
            $table->dropIndex(['parent_id']);
            $table->dropIndex(['level']);
            $table->dropIndex(['path']);
            
            // Eliminar columnas
            $table->dropColumn(['parent_id', 'level', 'path', 'sort_order']);
        });
    }
};
