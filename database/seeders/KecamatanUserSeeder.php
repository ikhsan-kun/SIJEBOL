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
        // Kecamatan Margadana
        User::updateOrCreate([
            'nik' => '1111222233334444',
        ], [
            'name' => 'Kecamatan Margadana',
            'email' => null,
            'password' => Hash::make('margadana123'),
            'role' => 'kecamatan',
        ]);

        // Kecamatan Tegal Barat
        User::updateOrCreate([
            'nik' => '2222333344445555',
        ], [
            'name' => 'Kecamatan Tegal Barat',
            'email' => null,
            'password' => Hash::make('tegalbarat123'),
            'role' => 'kecamatan',
        ]);

        // Kecamatan Tegal Selatan
        User::updateOrCreate([
            'nik' => '3333444455556666',
        ], [
            'name' => 'Kecamatan Tegal Selatan',
            'email' => null,
            'password' => Hash::make('tegalselatan123'),
            'role' => 'kecamatan',
        ]);

        // Kecamatan Tegal Timur
        User::updateOrCreate([
            'nik' => '4444555566667777',
        ], [
            'name' => 'Kecamatan Tegal Timur',
            'email' => null,
            'password' => Hash::make('tegaltimur123'),
            'role' => 'kecamatan',
        ]);
    }
}
