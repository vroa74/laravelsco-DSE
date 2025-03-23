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
        Schema::create('cos', function (Blueprint $table) {
            $table->id();
            $table->string('legislatura',length:15)->nullable();
            $table->date('fcap')->nullable();
            $table->date('frec')->nullable();
            $table->string('ncor',30)->nullable();
            $table->string('tcor',30)->nullable();
            $table->string('ccor',30)->nullable();
            $table->date('fofi')->nullable();
            $table->string('nofi',20)->nullable();
            $table->integer('nhoj')->nullable();
            $table->string('rem_nombre',70)->nullable();
            $table->string('rem_cargo',50)->nullable();
            $table->string('rem_deporg',60)->nullable();
            $table->text('rem_dir')->nullable();
            $table->text('des')->nullable();
            $table->text('seguimiento')->nullable();
            $table->string('tur_nom',70)->nullable();
            $table->string('tur_cargo',50)->nullable();
            $table->string('tur_deporg',60)->nullable();
            $table->string('creo',60)->nullable();
            $table->string('modifico',20)->nullable();
            $table->string('reporte',20)->nullable();
            $table->boolean('estatus')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cos');
    }
};
