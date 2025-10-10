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
        Schema::create('user_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100); // Nombre del grupo
            $table->text('description')->nullable(); // Descripción del grupo
            $table->boolean('active')->default(true); // Estado del grupo
            $table->unsignedBigInteger('created_by')->nullable(); // Quién creó el grupo
            $table->timestamps();
            
            // Llaves foráneas
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            
            // Índices
            $table->index('name');
            $table->index('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_groups');
    }
};
