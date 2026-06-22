<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kepuasan_warga', function (Blueprint $table) {
            $table->string('penilaian_petugas', 50)->nullable()->after('nilai_kepuasan');
            $table->string('penilaian_waktu', 50)->nullable()->after('penilaian_petugas');
            $table->string('penilaian_sistem', 50)->nullable()->after('penilaian_waktu');
        });
    }

    public function down(): void
    {
        Schema::table('kepuasan_warga', function (Blueprint $table) {
            $table->dropColumn(['penilaian_petugas', 'penilaian_waktu', 'penilaian_sistem']);
        });
    }
};
