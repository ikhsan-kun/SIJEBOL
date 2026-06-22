<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update existing records that still have the old default 'pending'
        DB::table('pengajuan_layanan')->where('status', 'pending')->update([
            'status' => 'menunggu_verifikasi',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('pengajuan_layanan')->where('status', 'menunggu_verifikasi')->update([
            'status' => 'pending',
        ]);
    }
};
