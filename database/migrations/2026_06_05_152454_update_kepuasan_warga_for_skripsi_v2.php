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
        Schema::table('kepuasan_warga', function (Blueprint $table) {
            $table->tinyInteger('rating_kecepatan')->nullable()->after('nilai_kepuasan');
            $table->tinyInteger('rating_kemudahan')->nullable()->after('rating_kecepatan');
            $table->tinyInteger('rating_keramahan')->nullable()->after('rating_kemudahan');
            $table->tinyInteger('rating_kejelasan')->nullable()->after('rating_keramahan');
            $table->string('status_layanan')->nullable()->after('rating_kejelasan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kepuasan_warga', function (Blueprint $table) {
            $table->dropColumn([
                'rating_kecepatan',
                'rating_kemudahan',
                'rating_keramahan',
                'rating_kejelasan',
                'status_layanan'
            ]);
        });
    }
};
