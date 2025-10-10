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
        Schema::create('ages', function (Blueprint $table) {
            $table->id();
            $table->char('titulo',5)->nullable();//titulochar(5)DEFAULTNULL
            $table->char('nombre',30)->nullable();//nombrechar(30)DEFAULTNULL
            $table->char('apaterno',30)->nullable();//apaternochar(30)DEFAULTNULL
            $table->char('amaterno',30)->nullable();//amaternochar(30)DEFAULTNULL
            $table->char('cargo',30)->nullable();//cargochar(30)DEFAULTNULL
            $table->char('deporg',60)->nullable();//deporgchar(60)DEFAULTNULL
            $table->char('telefono',255)->nullable();//telefonochar(255)DEFAULTNULL
            $table->char('email',255)->nullable();//emailchar(255)DEFAULTNULL
            $table->text('dir')->nullable();//dirtext
            $table->char('modifico',20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ages');
    }
};
