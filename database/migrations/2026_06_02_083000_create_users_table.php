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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->string('role', 30);
            $table->string('nik', 16)->unique();
            $table->string('phone', 15)->nullable();
            $table->string('location_type', 30)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('desa', 100)->nullable();
            $table->string('sekolah_level', 50)->nullable();
            $table->string('sekolah_kecamatan', 100)->nullable();
            $table->string('school', 100)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
