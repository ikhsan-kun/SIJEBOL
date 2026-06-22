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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('npsn', 50)->nullable();
            $table->string('nama_sekolah', 150);
            $table->text('alamat')->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('kelurahan', 100)->nullable();
            $table->string('tingkat', 50)->nullable();
            $table->integer('jumlah_siswa')->default(0);
            $table->string('status', 50)->nullable();
            $table->string('status_jempol', 50)->default('Belum');
            $table->unsignedBigInteger('cabang_id')->nullable();
            $table->string('fokus_layanan', 150)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
