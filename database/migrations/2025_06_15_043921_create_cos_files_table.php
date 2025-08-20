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
        Schema::create('cos_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cos_id');
            $table->string('original_name');           // Nombre original del archivo
            $table->string('file_name');               // Nombre único del archivo en el servidor
            $table->string('file_path');               // Ruta del archivo
            $table->string('file_type')->default('pdf'); // Tipo de archivo
            $table->bigInteger('file_size');           // Tamaño en bytes
            $table->text('description')->nullable();   // Descripción opcional del archivo
            $table->string('uploaded_by')->nullable(); // Quién subió el archivo
            $table->timestamps();
            
            // Llaves foráneas
            $table->foreign('cos_id')->references('id')->on('cos')->onDelete('cascade');
            
            // Índices para mejorar el rendimiento
            $table->index('cos_id');
            $table->index('file_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cos_files');
    }
};
