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
            // Eliminar llaves foráneas e índices primero
            $table->dropForeign(['parent_id']);
            $table->dropIndex(['parent_id']);
            $table->dropIndex(['level']);
            $table->dropIndex(['path']);
            
            // Eliminar columnas de jerarquía
            $table->dropColumn(['parent_id', 'level', 'path', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_groups', function (Blueprint $table) {
            // Restaurar columnas de jerarquía
            $table->unsignedBigInteger('parent_id')->nullable()->after('created_by');
            $table->integer('level')->default(0)->after('parent_id');
            $table->string('path', 500)->nullable()->after('level');
            $table->integer('sort_order')->default(0)->after('path');
            
            // Restaurar llaves foráneas e índices
            $table->foreign('parent_id')->references('id')->on('user_groups')->onDelete('set null');
            $table->index('parent_id');
            $table->index('level');
            $table->index('path');
        });
    }
};
