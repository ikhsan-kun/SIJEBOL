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
        DB::statement("ALTER TABLE jadwal_jebol MODIFY COLUMN status VARCHAR(50) DEFAULT 'Terjadwal'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE jadwal_jebol MODIFY COLUMN status ENUM('Terjadwal','Ditunda','Selesai') DEFAULT 'Terjadwal'");
    }
};
