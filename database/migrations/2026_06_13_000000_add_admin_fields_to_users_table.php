<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->unique()->after('name');
            $table->string('jabatan')->nullable()->after('phone');
            $table->text('alamat')->nullable()->after('jabatan');
            $table->string('foto_profil')->nullable()->after('alamat');
            $table->json('preferences')->nullable()->after('foto_profil');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'jabatan', 'alamat', 'foto_profil', 'preferences']);
        });
    }
};
