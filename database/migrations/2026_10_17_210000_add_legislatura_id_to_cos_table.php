<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('cos', 'legislatura_id')) {
            Schema::table('cos', function (Blueprint $table) {
                $table->unsignedBigInteger('legislatura_id')->nullable()->after('id');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('cos', 'legislatura_id')) {
            Schema::table('cos', function (Blueprint $table) {
                $table->dropColumn('legislatura_id');
            });
        }
    }
};
