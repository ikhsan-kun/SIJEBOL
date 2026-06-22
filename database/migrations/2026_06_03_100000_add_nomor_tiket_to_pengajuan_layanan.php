<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan_layanan', function (Blueprint $table) {
            if (!Schema::hasColumn('pengajuan_layanan', 'nomor_tiket')) {
                $table->string('nomor_tiket', 30)->nullable()->unique()->after('id_pengajuan');
            }
            if (!Schema::hasColumn('pengajuan_layanan', 'jumlah_realisasi')) {
                $table->integer('jumlah_realisasi')->nullable()->after('lokasi_pelayanan');
            }
            if (!Schema::hasColumn('pengajuan_layanan', 'jumlah_petugas')) {
                $table->integer('jumlah_petugas')->nullable()->after('jumlah_realisasi');
            }
            if (!Schema::hasColumn('pengajuan_layanan', 'jumlah_ikd')) {
                $table->integer('jumlah_ikd')->nullable()->after('jumlah_petugas');
            }
            if (!Schema::hasColumn('pengajuan_layanan', 'jumlah_kia')) {
                $table->integer('jumlah_kia')->nullable()->after('jumlah_ikd');
            }
            if (!Schema::hasColumn('pengajuan_layanan', 'tanggal_selesai')) {
                $table->datetime('tanggal_selesai')->nullable()->after('tanggal_pengajuan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_layanan', function (Blueprint $table) {
            $table->dropColumn([
                'nomor_tiket',
                'jumlah_realisasi',
                'jumlah_petugas',
                'jumlah_ikd',
                'jumlah_kia',
                'tanggal_selesai',
            ]);
        });
    }
};
