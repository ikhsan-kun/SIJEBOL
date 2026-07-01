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
        Schema::dropIfExists('informasi');
        Schema::dropIfExists('warga_usulan_jebols');
        Schema::dropIfExists('permohonan_jebols');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recreating these tables is possible but typically not needed for abandoned tables.
        // I will leave it empty, or could recreate them based on old schemas if necessary.
        // For now, no need to revert.
    }
};
