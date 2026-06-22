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
        Schema::create('warga_usulan_jebols', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permohonan_jebol_id')->constrained('permohonan_jebols')->onDelete('cascade');
            $table->string('nik', 16);
            $table->string('nama', 100);
            $table->string('jenis_layanan', 100);
            $table->text('keterangan')->nullable();
            $table->enum('status_layanan', ['pending', 'selesai'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warga_usulan_jebols');
    }
};
