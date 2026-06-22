<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Create master_kecamatan table
        Schema::create('master_kecamatan', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 50)->nullable()->unique();
            $table->string('nama', 100);
            $table->text('keterangan')->nullable();
            $table->string('status', 20)->default('Aktif');
            $table->timestamps();
        });

        // Seed master_kecamatan
        DB::table('master_kecamatan')->insert([
            ['kode' => 'KEC01', 'nama' => 'Tegal Barat', 'keterangan' => 'Kecamatan Tegal Barat', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'KEC02', 'nama' => 'Tegal Timur', 'keterangan' => 'Kecamatan Tegal Timur', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'KEC03', 'nama' => 'Tegal Selatan', 'keterangan' => 'Kecamatan Tegal Selatan', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'KEC04', 'nama' => 'Margadana', 'keterangan' => 'Kecamatan Margadana', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 2. Create master_kelurahan table
        Schema::create('master_kelurahan', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 50)->nullable()->unique();
            $table->string('nama', 100);
            $table->string('kecamatan_nama', 100);
            $table->string('status', 20)->default('Aktif');
            $table->timestamps();
        });

        // Seed master_kelurahan
        DB::table('master_kelurahan')->insert([
            // Tegal Barat
            ['kode' => 'KEL01', 'nama' => 'Tegalsari', 'kecamatan_nama' => 'Tegal Barat', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'KEL02', 'nama' => 'Kraton', 'kecamatan_nama' => 'Tegal Barat', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'KEL03', 'nama' => 'Pekauman', 'kecamatan_nama' => 'Tegal Barat', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'KEL04', 'nama' => 'Pesurungan Kidul', 'kecamatan_nama' => 'Tegal Barat', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'KEL05', 'nama' => 'Debong Lor', 'kecamatan_nama' => 'Tegal Barat', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'KEL06', 'nama' => 'Muarareja', 'kecamatan_nama' => 'Tegal Barat', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'KEL07', 'nama' => 'Pesurungan Lor', 'kecamatan_nama' => 'Tegal Barat', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],

            // Tegal Timur
            ['kode' => 'KEL08', 'nama' => 'Mintaragen', 'kecamatan_nama' => 'Tegal Timur', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'KEL09', 'nama' => 'Slerok', 'kecamatan_nama' => 'Tegal Timur', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'KEL10', 'nama' => 'Kejambon', 'kecamatan_nama' => 'Tegal Timur', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'KEL11', 'nama' => 'Panggung', 'kecamatan_nama' => 'Tegal Timur', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'KEL12', 'nama' => 'Mangkukusuman', 'kecamatan_nama' => 'Tegal Timur', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],

            // Tegal Selatan
            ['kode' => 'KEL13', 'nama' => 'Randugunting', 'kecamatan_nama' => 'Tegal Selatan', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'KEL14', 'nama' => 'Debong Tengah', 'kecamatan_nama' => 'Tegal Selatan', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'KEL15', 'nama' => 'Debong Kulon', 'kecamatan_nama' => 'Tegal Selatan', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'KEL16', 'nama' => 'Tunon', 'kecamatan_nama' => 'Tegal Selatan', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'KEL17', 'nama' => 'Bandung', 'kecamatan_nama' => 'Tegal Selatan', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'KEL18', 'nama' => 'Kalinyamat Wetan', 'kecamatan_nama' => 'Tegal Selatan', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],

            // Margadana
            ['kode' => 'KEL19', 'nama' => 'Margadana', 'kecamatan_nama' => 'Margadana', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'KEL20', 'nama' => 'Sumurpanggang', 'kecamatan_nama' => 'Margadana', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'KEL21', 'nama' => 'Kalinyamat Kulon', 'kecamatan_nama' => 'Margadana', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'KEL22', 'nama' => 'Cabawan', 'kecamatan_nama' => 'Margadana', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'KEL23', 'nama' => 'Krandon', 'kecamatan_nama' => 'Margadana', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 3. Create master_status_layanan table
        Schema::create('master_status_layanan', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 50)->nullable()->unique();
            $table->string('nama', 100);
            $table->string('warna', 50)->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        // Seed master_status_layanan
        DB::table('master_status_layanan')->insert([
            ['kode' => 'S001', 'nama' => 'menunggu_verifikasi', 'warna' => 'yellow', 'deskripsi' => 'Menunggu verifikasi admin', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'S002', 'nama' => 'terverifikasi', 'warna' => 'blue', 'deskripsi' => 'Berkas terverifikasi', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'S003', 'nama' => 'terjadwal', 'warna' => 'purple', 'deskripsi' => 'Layanan telah dijadwalkan', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'S004', 'nama' => 'diproses', 'warna' => 'orange', 'deskripsi' => 'Sedang diproses petugas', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'S005', 'nama' => 'selesai', 'warna' => 'green', 'deskripsi' => 'Layanan selesai diproses', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'S006', 'nama' => 'ditolak', 'warna' => 'red', 'deskripsi' => 'Pengajuan ditolak', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_status_layanan');
        Schema::dropIfExists('master_kelurahan');
        Schema::dropIfExists('master_kecamatan');
    }
};
