<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_jenis_layanan', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 50)->unique();
            $table->string('nama', 150);
            $table->text('deskripsi')->nullable();
            $table->string('status', 20)->default('Aktif');
            $table->timestamps();
        });

        // Insert a few default active services
        \Illuminate\Support\Facades\DB::table('master_jenis_layanan')->insert([
            ['kode' => 'L001', 'nama' => 'Pelayanan KTP', 'deskripsi' => 'Penerbitan KTP elektronik', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'L002', 'nama' => 'Pelayanan Akta', 'deskripsi' => 'Penerbitan akta kelahiran', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'L003', 'nama' => 'Pelayanan KK', 'deskripsi' => 'Pembuatan kartu keluarga', 'status' => 'Aktif', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('master_jenis_layanan');
    }
};
