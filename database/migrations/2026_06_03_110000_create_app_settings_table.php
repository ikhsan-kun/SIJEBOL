<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('app_settings')) {
            Schema::create('app_settings', function (Blueprint $table) {
                $table->id();
                $table->string('app_name')->default('SI JEBOL');
                $table->string('app_tagline')->nullable();
                $table->string('agency_name')->nullable()->default('Disdukcapil Kota Tegal');
                $table->string('agency_logo')->nullable();
                $table->string('contact_phone')->nullable();
                $table->string('contact_email')->nullable();
                $table->string('contact_address')->nullable();
                $table->text('operational_hours')->nullable();
                $table->text('notification_settings')->nullable();
                $table->text('document_templates')->nullable();
                $table->timestamps();
            });
        }

        // Add any missing columns to existing table
        Schema::table('app_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('app_settings', 'agency_logo')) {
                $table->string('agency_logo')->nullable();
            }
            if (!Schema::hasColumn('app_settings', 'operational_hours')) {
                $table->text('operational_hours')->nullable();
            }
            if (!Schema::hasColumn('app_settings', 'notification_settings')) {
                $table->text('notification_settings')->nullable();
            }
            if (!Schema::hasColumn('app_settings', 'document_templates')) {
                $table->text('document_templates')->nullable();
            }
        });

        // Insert default row if empty
        if (DB::table('app_settings')->count() === 0) {
            DB::table('app_settings')->insert([
                'app_name'              => 'SI JEBOL',
                'app_tagline'           => 'Jemput Bola Online Disdukcapil Kota Tegal',
                'agency_name'           => 'Dinas Kependudukan dan Pencatatan Sipil Kota Tegal',
                'agency_logo'           => null,
                'contact_phone'         => '(0283) 351001',
                'contact_email'         => 'disdukcapil@tegalkota.go.id',
                'contact_address'       => 'Jl. Ki Gede Sebayu No.2, Tegal Timur, Kota Tegal',
                'operational_hours'     => json_encode([
                    'senin_kamis' => '08:00 - 15:30',
                    'jumat'       => '08:00 - 11:00',
                    'sabtu_minggu'=> 'Tutup',
                ]),
                'notification_settings' => json_encode([
                    'email_pengajuan_baru'   => false,
                    'email_perubahan_jadwal' => false,
                    'wa_active'              => false,
                    'wa_gateway_url'         => '',
                    'wa_api_key'             => '',
                ]),
                'document_templates'    => null,
                'created_at'            => now(),
                'updated_at'            => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('app_settings');
    }
};
