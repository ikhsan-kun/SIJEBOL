<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Masyarakat;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        $mUser = User::updateOrCreate(
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

        Masyarakat::updateOrCreate(
            ['nik' => $mUser->nik],
            [
                'nama' => $mUser->name,
                'email' => $mUser->email,
                'password' => $mUser->password,
                'no_hp' => $mUser->phone,
                'alamat' => 'Kelurahan Mintaragen, Tegal Timur',
                'role' => 'user'
            ]
        );

        // 4. Sample Jadwal
        DB::table('jadwal_jebol')->insert([
            [
                'nama_kegiatan' => 'Jemput Bola Kelurahan Mintaragen',
                'jenis_lokasi' => 'Kecamatan',
                'lokasi' => 'Kec. Tegal Timur - Kelurahan Mintaragen',
                'tanggal_pelayanan' => now()->addDays(2)->format('Y-m-d'),
                'jam_mulai' => '09:00:00',
                'jam_selesai' => '12:00:00',
                'kuota' => 50,
                'petugas' => 'Tim Disdukcapil Tegal Timur',
                'jenis_layanan' => 'KTP-el',
                'status' => 'Terjadwal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kegiatan' => 'Jemput Bola SMKN 3 Kota Tegal',
                'jenis_lokasi' => 'Sekolah',
                'lokasi' => 'SMKN 3 Kota Tegal',
                'tanggal_pelayanan' => now()->addDays(3)->format('Y-m-d'),
                'jam_mulai' => '10:00:00',
                'jam_selesai' => '15:00:00',
                'kuota' => 100,
                'petugas' => 'Tim Disdukcapil Kota Tegal',
                'jenis_layanan' => 'KIA',
                'status' => 'Terjadwal',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 5. Sample Permohonan
        DB::table('pengajuan_layanan')->insert([
            [
                'nik' => $mUser->nik,
                'nomor_tiket' => 'JB-' . date('Ymd') . '-' . strtoupper(Str::random(4)),
                'jenis_layanan' => 'KTP-el Baru',
                'jenis_pengajuan' => 'Baru',
                'no_hp' => $mUser->phone,
                'alamat' => 'Kelurahan Mintaragen, Tegal Timur',
                'keterangan' => 'Permohonan KTP-el karena baru berusia 17 tahun.',
                'lokasi_pelayanan' => 'Kec. Tegal Timur - Kelurahan Mintaragen',
                'status' => 'menunggu_verifikasi',
                'tanggal_pengajuan' => now(),
                'detail_pengajuan' => json_encode([
                    'nama' => $mUser->name,
                    'nik' => $mUser->nik,
                    'tempat_lahir' => 'Tegal',
                    'tanggal_lahir' => '2009-06-22',
                    'jenis_kelamin' => 'Laki-laki',
                    'golongan_darah' => 'O',
                    'agama' => 'Islam',
                    'status_perkawinan' => 'Belum Kawin',
                    'pekerjaan' => 'Pelajar/Mahasiswa',
                    'kewarganegaraan' => 'WNI'
                ])
            ]
        ]);
    }
}
