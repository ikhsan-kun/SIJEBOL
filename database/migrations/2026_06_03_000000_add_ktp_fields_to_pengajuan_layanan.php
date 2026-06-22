<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan_layanan', function (Blueprint $table) {
            if (!Schema::hasColumn('pengajuan_layanan', 'jenis_pengajuan')) {
                $table->string('jenis_pengajuan', 100)->nullable()->after('jenis_layanan');
            }
            if (!Schema::hasColumn('pengajuan_layanan', 'no_hp')) {
                $table->string('no_hp', 20)->nullable()->after('nik');
            }
            if (!Schema::hasColumn('pengajuan_layanan', 'alamat')) {
                $table->text('alamat')->nullable()->after('no_hp');
            }
            if (!Schema::hasColumn('pengajuan_layanan', 'keterangan')) {
                $table->text('keterangan')->nullable()->after('alamat');
            }
            if (!Schema::hasColumn('pengajuan_layanan', 'berkas_pendukung')) {
                $table->text('berkas_pendukung')->nullable()->after('keterangan');
            }
            if (!Schema::hasColumn('pengajuan_layanan', 'lokasi_pelayanan')) {
                $table->string('lokasi_pelayanan', 150)->nullable()->after('berkas_pendukung');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_layanan', function (Blueprint $table) {
            $table->dropColumn([
                'jenis_pengajuan',
                'no_hp',
                'alamat',
                'keterangan',
                'berkas_pendukung',
                'lokasi_pelayanan'
            ]);
        });
    }
};
