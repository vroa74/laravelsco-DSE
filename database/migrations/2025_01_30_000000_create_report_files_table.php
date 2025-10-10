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
        Schema::create('report_files', function (Blueprint $table) {
            $table->id();
            
            // Relación con el reporte (puede ser Co o cualquier otro modelo de reporte)
            $table->unsignedBigInteger('report_id');
            $table->string('report_type'); // 'co', 'age', etc.
            
            // Información del archivo
            $table->string('original_name'); // Nombre original del archivo
            $table->string('file_path'); // Ruta en el storage
            $table->string('file_name'); // Nombre único del archivo
            $table->string('mime_type')->default('application/pdf');
            $table->bigInteger('file_size'); // Tamaño en bytes
            
            // Control de descargas
            $table->integer('download_count')->default(0);
            $table->integer('max_downloads')->default(5);
            
            // Control de tiempo de vida
            $table->timestamp('expires_at'); // Fecha de expiración (7 días)
            $table->timestamps();
            
            // Índices para optimizar consultas
            $table->index(['report_id', 'report_type']);
            $table->index('expires_at');
            $table->index('download_count');
            
            // Claves foráneas (ajustar según tus modelos)
            // $table->foreign('report_id')->references('id')->on('cos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_files');
    }
}; 