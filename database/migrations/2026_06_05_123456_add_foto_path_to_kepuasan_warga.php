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
        Schema::table('kepuasan_warga', function (Blueprint $table) {
            $table->string('foto_path')->nullable()->after('kritik_saran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kepuasan_warga', function (Blueprint $table) {
            $table->dropColumn('foto_path');
        });
    }
};
