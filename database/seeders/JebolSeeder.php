<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class JebolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Admin Pusat
        User::updateOrCreate(
            ['email' => 'admin@jebol.com'],
            [
                'name' => 'Admin Pusat SI JEBOL',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'nik' => '1234567890123456',
                'phone' => '08123456789',
                'location_type' => 'pusat'
            ]
        );

        // 2. Petugas Cabang Dinas (Petugas)
        User::updateOrCreate(
            ['email' => 'petugas@jebol.com'],
            [
                'name' => 'Budi Pratama (Petugas Tegal Barat)',
                'password' => Hash::make('petugas123'),
                'role' => 'petugas',
                'nik' => '3328010101010001',
                'phone' => '082233445566',
                'location_type' => 'kecamatan',
                'kecamatan' => 'Tegal Barat'
            ]
        );

        // 3. Masyarakat (User)
        User::updateOrCreate(
            ['email' => 'masyarakat@gmail.com'],
            [
                'name' => 'Ahmad Subarjo',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'nik' => '3328010203040001',
                'phone' => '085566778899',
                'location_type' => 'kecamatan',
                'kecamatan' => 'Tegal Timur',
                'desa' => 'Mintaragen'
            ]
        );

        // 4. Sample Jadwal
        DB::table('jadwal_petugas')->insert([
            [
                'lokasi' => 'Kelurahan Mintaragen',
                'tanggal' => now()->addDays(2)->format('Y-m-d'),
                'jam_mulai' => '09:00:00',
                'jam_selesai' => '12:00:00',
                'kuota' => 50,
                'terisi' => 5,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'lokasi' => 'SMKN 3 Kota Tegal',
                'tanggal' => now()->addDays(3)->format('Y-m-d'),
                'jam_mulai' => '10:00:00',
                'jam_selesai' => '15:00:00',
                'kuota' => 100,
                'terisi' => 12,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 5. Sample Permohonan
        DB::table('permohonan')->insert([
            [
                'user_id' => User::where('role', 'user')->first()->id,
                'nomor_tiket' => 'TBL-' . strtoupper(uniqid()),
                'jenis_layanan' => 'KTP-el Baru',
                'status' => 'pending',
                'keterangan' => 'Permohonan KTP-el karena baru berusia 17 tahun.',
                'tanggal_pengajuan' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
