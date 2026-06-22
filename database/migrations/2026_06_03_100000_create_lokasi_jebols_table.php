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
        Schema::create('lokasi_jebols', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lokasi');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->text('alamat_lengkap');
            $table->integer('kuota_peserta')->default(0);
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokasi_jebols');
    }
};
