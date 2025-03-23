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
        Schema::create('ccors', function (Blueprint $table) {
            $table->id();
            $table->integer('tcor');  // tcor int NOT NULL
            $table->string('ccor', 100);  // ccor varchar(100) NOT NULL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ccors');
    }
};
