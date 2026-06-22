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
        Schema::table('jadwal_jebol', function (Blueprint $table) {
            $table->string('nama_kegiatan', 255)->after('id_jadwal')->nullable();
            $table->time('jam_mulai')->after('tanggal')->nullable();
            $table->time('jam_selesai')->after('jam_mulai')->nullable();
            $table->string('petugas', 255)->after('jam_selesai')->nullable();
            $table->string('kategori', 100)->after('petugas')->nullable();
            $table->string('warna', 50)->after('kategori')->default('blue');
            $table->enum('status', ['terjadwal', 'selesai'])->after('keterangan')->default('terjadwal');
        });

        // Copy existing waktu to jam_mulai as a fallback
        \Illuminate\Support\Facades\DB::statement('UPDATE jadwal_jebol SET jam_mulai = waktu');

        Schema::table('jadwal_jebol', function (Blueprint $table) {
            $table->dropColumn('waktu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_jebol', function (Blueprint $table) {
            $table->time('waktu')->after('tanggal')->nullable();
        });

        \Illuminate\Support\Facades\DB::statement('UPDATE jadwal_jebol SET waktu = jam_mulai');

        Schema::table('jadwal_jebol', function (Blueprint $table) {
            $table->dropColumn([
                'nama_kegiatan',
                'jam_mulai',
                'jam_selesai',
                'petugas',
                'kategori',
                'warna',
                'status'
            ]);
        });
    }
};
