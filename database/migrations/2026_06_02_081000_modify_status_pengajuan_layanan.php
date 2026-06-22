<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Change default value of status column and ensure it uses the new workflow values.
        Schema::table('pengajuan_layanan', function (Blueprint $table) {
            $table->string('status', 50)
                ->default('menunggu_verifikasi')
                ->comment('menunggu_verifikasi, terverifikasi, terjadwal, diproses, selesai, ditolak, perlu_perbaikan')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_layanan', function (Blueprint $table) {
            $table->string('status', 50)
                ->default('pending')
                ->change();
        });
    }
};
