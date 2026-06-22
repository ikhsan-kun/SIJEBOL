<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KecamatanUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kecamatans = [
            [
                'nik' => '1111222233334444',
                'name' => 'Kecamatan Margadana',
                'password' => 'margadana123',
                'kecamatan' => 'Margadana'
            ],
            [
                'nik' => '2222333344445555',
                'name' => 'Kecamatan Tegal Barat',
                'password' => 'tegalbarat123',
                'kecamatan' => 'Tegal Barat'
            ],
            [
                'nik' => '3333444455556666',
                'name' => 'Kecamatan Tegal Selatan',
                'password' => 'tegalselatan123',
                'kecamatan' => 'Tegal Selatan'
            ],
            [
                'nik' => '4444555566667777',
                'name' => 'Kecamatan Tegal Timur',
                'password' => 'tegaltimur123',
                'kecamatan' => 'Tegal Timur'
            ]
        ];

        foreach ($kecamatans as $k) {
            User::updateOrCreate([
                'nik' => $k['nik'],
            ], [
                'name' => $k['name'],
                'email' => null,
                'password' => Hash::make($k['password']),
                'role' => 'kecamatan',
                'location_type' => 'kecamatan',
                'kecamatan' => $k['kecamatan']
            ]);

            \App\Models\Masyarakat::updateOrCreate([
                'nik' => $k['nik'],
            ], [
                'nama' => $k['name'],
                'email' => $k['nik'] . '@jebol.com',
                'password' => Hash::make($k['password']),
                'role' => 'kecamatan',
                'tipe_pendaftar' => 'kecamatan',
                'kecamatan' => $k['kecamatan'],
                'alamat' => 'Kantor Kecamatan ' . $k['kecamatan'],
            ]);
        }
    }
}
