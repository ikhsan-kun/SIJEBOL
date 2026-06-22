<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Masyarakat
        Schema::create('masyarakat', function (Blueprint $table) {
            $table->integer('id_masyarakat')->autoIncrement();
            $table->string('nik', 16)->unique();
            $table->string('nama', 100);
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->string('no_hp', 15)->nullable();
            $table->text('alamat')->nullable();
            $table->string('foto_profil', 255)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        // Tabel Admin
        Schema::create('admin', function (Blueprint $table) {
            $table->integer('id_admin')->autoIncrement();
            $table->string('nama_admin', 100);
            $table->string('username', 50)->unique();
            $table->string('password', 255);
            $table->enum('role', ['admin', 'petugas'])->default('admin');
            $table->timestamps();
        });

        // Tabel Pengajuan Layanan
        Schema::create('pengajuan_layanan', function (Blueprint $table) {
            $table->integer('id_pengajuan')->autoIncrement();
            $table->string('nik', 16);
            $table->string('jenis_layanan', 100);
            $table->datetime('tanggal_pengajuan');
            $table->string('status', 50)->default('pending');
            $table->text('detail_pengajuan')->nullable();
            $table->string('file_upload', 255)->nullable();
            $table->text('catatan_admin')->nullable();
            $table->string('file_balasan', 255)->nullable();
            
            $table->foreign('nik')->references('nik')->on('masyarakat')->onDelete('cascade');
        });

        // Tabel Jadwal JEBOL
        Schema::create('jadwal_jebol', function (Blueprint $table) {
            $table->integer('id_jadwal')->autoIncrement();
            $table->string('lokasi', 100);
            $table->date('tanggal');
            $table->time('waktu');
            $table->text('keterangan')->nullable();
        });

        // Tabel Kepuasan Warga
        Schema::create('kepuasan_warga', function (Blueprint $table) {
            $table->integer('id_kepuasan')->autoIncrement();
            $table->string('nik', 16);
            $table->integer('nilai_kepuasan');
            $table->text('kritik_saran')->nullable();
            $table->datetime('tanggal_input');

            $table->foreign('nik')->references('nik')->on('masyarakat')->onDelete('cascade');
        });

        // Tabel Informasi
        Schema::create('informasi', function (Blueprint $table) {
            $table->integer('id_informasi')->autoIncrement();
            $table->string('judul', 150);
            $table->text('isi_informasi');
            $table->datetime('tanggal_posting');
        });

        // Default Laravel Auth requirements
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->integer('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('informasi');
        Schema::dropIfExists('kepuasan_warga');
        Schema::dropIfExists('jadwal_jebol');
        Schema::dropIfExists('pengajuan_layanan');
        Schema::dropIfExists('admin');
        Schema::dropIfExists('masyarakat');
    }
};
