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
            // Check and drop columns if they exist before renaming/changing, or handle via Doctrine
            // But since renaming can have issues with Doctrine DBAL, let's do it safely.
        });

        // 1. Rename columns
        if (Schema::hasColumn('jadwal_jebol', 'tanggal')) {
            Schema::table('jadwal_jebol', function (Blueprint $table) {
                $table->renameColumn('tanggal', 'tanggal_pelayanan');
            });
        }
        
        if (Schema::hasColumn('jadwal_jebol', 'kategori')) {
            Schema::table('jadwal_jebol', function (Blueprint $table) {
                $table->renameColumn('kategori', 'jenis_layanan');
            });
        }

        if (Schema::hasColumn('jadwal_jebol', 'keterangan')) {
            Schema::table('jadwal_jebol', function (Blueprint $table) {
                $table->renameColumn('keterangan', 'deskripsi');
            });
        }

        // 2. Modify enum & add columns
        // For enum modification in Laravel, it's often safer to drop and recreate, or use DB::statement.
        // We will drop 'status' and recreate it to safely update enum values.
        
        // Wait, 'status' was enum('terjadwal', 'selesai'). We want ('Terjadwal', 'Ditunda', 'Selesai').
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE jadwal_jebol MODIFY COLUMN status ENUM('Terjadwal', 'Ditunda', 'Selesai') DEFAULT 'Terjadwal'");
        
        Schema::table('jadwal_jebol', function (Blueprint $table) {
            if (!Schema::hasColumn('jadwal_jebol', 'jenis_lokasi')) {
                $table->enum('jenis_lokasi', ['Kecamatan', 'Sekolah'])->after('nama_kegiatan')->nullable();
            }
            if (!Schema::hasColumn('jadwal_jebol', 'kuota')) {
                $table->integer('kuota')->after('jenis_layanan')->nullable()->default(100);
            }
            if (!Schema::hasColumn('jadwal_jebol', 'created_at')) {
                $table->timestamps(); // Adds created_at and updated_at
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_jebol', function (Blueprint $table) {
            if (Schema::hasColumn('jadwal_jebol', 'jenis_lokasi')) {
                $table->dropColumn('jenis_lokasi');
            }
            if (Schema::hasColumn('jadwal_jebol', 'kuota')) {
                $table->dropColumn('kuota');
            }
            if (Schema::hasColumn('jadwal_jebol', 'created_at')) {
                $table->dropTimestamps();
            }
        });

        if (Schema::hasColumn('jadwal_jebol', 'tanggal_pelayanan')) {
            Schema::table('jadwal_jebol', function (Blueprint $table) {
                $table->renameColumn('tanggal_pelayanan', 'tanggal');
            });
        }

        if (Schema::hasColumn('jadwal_jebol', 'jenis_layanan')) {
            Schema::table('jadwal_jebol', function (Blueprint $table) {
                $table->renameColumn('jenis_layanan', 'kategori');
            });
        }

        if (Schema::hasColumn('jadwal_jebol', 'deskripsi')) {
            Schema::table('jadwal_jebol', function (Blueprint $table) {
                $table->renameColumn('deskripsi', 'keterangan');
            });
        }
        
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE jadwal_jebol MODIFY COLUMN status ENUM('terjadwal', 'selesai') DEFAULT 'terjadwal'");
    }
};
