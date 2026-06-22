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
        Schema::table('informasi', function (Blueprint $table) {
            $table->enum('tipe', ['berita', 'pengumuman'])->after('id_informasi')->default('berita');
            $table->string('slug', 255)->after('judul')->nullable();
            $table->string('gambar', 255)->after('isi_informasi')->nullable();
            $table->enum('status', ['draft', 'publikasi'])->after('gambar')->default('publikasi');
        });
        
        Schema::table('informasi', function (Blueprint $table) {
            $table->renameColumn('isi_informasi', 'konten');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('informasi', function (Blueprint $table) {
            $table->renameColumn('konten', 'isi_informasi');
        });

        Schema::table('informasi', function (Blueprint $table) {
            $table->dropColumn([
                'tipe',
                'slug',
                'gambar',
                'status'
            ]);
        });
    }
};
