<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cabang = \App\Models\User::where('role', 'petugas')->first();
        if (!$cabang) {
            $cabang = \App\Models\User::where('role', 'cabang_dinas')->first()
                      ?? \App\Models\User::where('role', 'admin')->first();
        }
        if (!$cabang) {
            $cabang = \App\Models\User::create([
                'name' => 'Default Petugas',
                'email' => 'petugas@jebol.com',
                'password' => \Illuminate\Support\Facades\Hash::make('petugas123'),
                'role' => 'petugas',
                'nik' => '3328010101010001',
                'phone' => '082233445566',
                'location_type' => 'kecamatan',
                'kecamatan' => 'Tegal Timur'
            ]);
        }

        $schools = [
            // SD Negeri
            ['nama' => 'SD Negeri Bandung 1', 'tingkat' => 'SD'],
            ['nama' => 'SD Negeri Bandung 2', 'tingkat' => 'SD'],
            ['nama' => 'SD Negeri Debong Tengah 1', 'tingkat' => 'SD'],
            ['nama' => 'SD Negeri Debong Tengah 2', 'tingkat' => 'SD'],
            ['nama' => 'SD Negeri Kemandungan 1', 'tingkat' => 'SD'],
            ['nama' => 'SD Negeri Kraton 1', 'tingkat' => 'SD'],
            ['nama' => 'SD Negeri Mangkukusuman 1', 'tingkat' => 'SD'],
            ['nama' => 'SD Negeri Mintaragen 1', 'tingkat' => 'SD'],
            ['nama' => 'SD Negeri Panggung 1', 'tingkat' => 'SD'],
            ['nama' => 'SD Negeri Panggung 2', 'tingkat' => 'SD'],
            ['nama' => 'SD Negeri Panggung 3', 'tingkat' => 'SD'],
            ['nama' => 'SD Negeri Panggung 4', 'tingkat' => 'SD'],
            ['nama' => 'SD Negeri Pesurungan Kidul 1', 'tingkat' => 'SD'],
            ['nama' => 'SD Negeri Pesurungan Lor 1', 'tingkat' => 'SD'],
            ['nama' => 'SD Negeri Randugunting 1', 'tingkat' => 'SD'],
            ['nama' => 'SD Negeri Tegalsari 1', 'tingkat' => 'SD'],
            ['nama' => 'SD Negeri Tunon 1', 'tingkat' => 'SD'],
            ['nama' => 'SD Negeri Kalinyamat Kulon 1', 'tingkat' => 'SD'],
            ['nama' => 'SD Negeri Kalinyamat Wetan 1', 'tingkat' => 'SD'],
            
            // SD Swasta
            ['nama' => 'SD Muhammadiyah 1 Tegal', 'tingkat' => 'SD'],
            ['nama' => 'SD Muhammadiyah 2 Tegal', 'tingkat' => 'SD'],
            ['nama' => 'SD Muhammadiyah 3 Tegal', 'tingkat' => 'SD'],
            ['nama' => 'SD Pius Tegal', 'tingkat' => 'SD'],
            ['nama' => 'SD Ihsaniyah Tegal', 'tingkat' => 'SD'],
            ['nama' => 'SD Islam Terpadu Al Ikhlas', 'tingkat' => 'SD'],
            ['nama' => 'SD IT BIAS Assalam', 'tingkat' => 'SD'],
            ['nama' => 'SD Al-Irsyad Tegal', 'tingkat' => 'SD'],
            ['nama' => 'SD Bhakti Praja', 'tingkat' => 'SD'],
            ['nama' => 'SD Islam Hidayatullah', 'tingkat' => 'SD'],

            // SMP Negeri
            ['nama' => 'SMP Negeri 1 Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'SMP Negeri 2 Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'SMP Negeri 3 Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'SMP Negeri 4 Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'SMP Negeri 5 Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'SMP Negeri 6 Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'SMP Negeri 7 Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'SMP Negeri 8 Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'SMP Negeri 9 Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'SMP Negeri 10 Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'SMP Negeri 11 Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'SMP Negeri 12 Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'SMP Negeri 13 Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'SMP Negeri 14 Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'SMP Negeri 15 Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'SMP Negeri 16 Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'SMP Negeri 17 Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'SMP Negeri 18 Tegal', 'tingkat' => 'SMP'],

            // SMP Swasta
            ['nama' => 'SMP Muhammadiyah 1 Kota Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'SMP Muhammadiyah 2 Kota Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'SMP Pius Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'SMP Ihsaniyah Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'SMP Islam Terpadu Usamah', 'tingkat' => 'SMP'],
            ['nama' => 'SMP Ma’arif NU Kota Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'SMP IC BIAS Assalam', 'tingkat' => 'SMP'],
            ['nama' => 'SMP Al-Irsyad Kota Tegal', 'tingkat' => 'SMP'],

            // MI
            ['nama' => 'MI Negeri Kota Tegal', 'tingkat' => 'SD'],
            ['nama' => 'MI Salafiyah', 'tingkat' => 'SD'],
            ['nama' => 'MI Al-Ikhsan', 'tingkat' => 'SD'],
            ['nama' => 'MI Muhammadiyah Tegal', 'tingkat' => 'SD'],
            ['nama' => 'MI Miftahul Ulum', 'tingkat' => 'SD'],
            ['nama' => 'MI Hidayatul Athfal', 'tingkat' => 'SD'],

            // MTs
            ['nama' => 'MTs Negeri Kota Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'MTs Muhammadiyah Kota Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'MTs Ma’arif NU Kota Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'MTs Al-Irsyad Kota Tegal', 'tingkat' => 'SMP'],
            ['nama' => 'MTs Salafiyah Kota Tegal', 'tingkat' => 'SMP'],

            // SMA Negeri
            ['nama' => 'SMA Negeri 1 Tegal', 'tingkat' => 'SMA'],
            ['nama' => 'SMA Negeri 2 Tegal', 'tingkat' => 'SMA'],
            ['nama' => 'SMA Negeri 3 Tegal', 'tingkat' => 'SMA'],
            ['nama' => 'SMA Negeri 4 Tegal', 'tingkat' => 'SMA'],
            ['nama' => 'SMA Negeri 5 Tegal', 'tingkat' => 'SMA'],

            // SMA Swasta
            ['nama' => 'SMA Muhammadiyah Tegal', 'tingkat' => 'SMA'],
            ['nama' => 'SMA Pius Tegal', 'tingkat' => 'SMA'],
            ['nama' => 'SMA Ihsaniyah Tegal', 'tingkat' => 'SMA'],
            ['nama' => 'SMA Al-Irsyad Tegal', 'tingkat' => 'SMA'],
            ['nama' => 'SMA Pancasakti Tegal', 'tingkat' => 'SMA'],

            // SMK Negeri
            ['nama' => 'SMK Negeri 1 Tegal', 'tingkat' => 'SMK'],
            ['nama' => 'SMK Negeri 2 Tegal', 'tingkat' => 'SMK'],
            ['nama' => 'SMK Negeri 3 Tegal', 'tingkat' => 'SMK'],

            // SMK Swasta
            ['nama' => 'SMK Muhammadiyah 1 Tegal', 'tingkat' => 'SMK'],
            ['nama' => 'SMK Muhammadiyah 2 Tegal', 'tingkat' => 'SMK'],
            ['nama' => 'SMK Bhakti Praja Tegal', 'tingkat' => 'SMK'],
            ['nama' => 'SMK YPT Tegal', 'tingkat' => 'SMK'],
            ['nama' => 'SMK Al-Irsyad Tegal', 'tingkat' => 'SMK'],
            ['nama' => 'SMK Astrindo Tegal', 'tingkat' => 'SMK'],

            // SLB
            ['nama' => 'SLB Negeri Kota Tegal', 'tingkat' => 'SLB'],
            ['nama' => 'SLB Harapan Ibu Tegal', 'tingkat' => 'SLB'],
            ['nama' => 'SLB Karya Bhakti Tegal', 'tingkat' => 'SLB'],
        ];

        $faker = \Faker\Factory::create('id_ID');

        foreach ($schools as $school) {
            \App\Models\School::create([
                'npsn' => $faker->unique()->numerify('########'),
                'nama_sekolah' => $school['nama'],
                'alamat' => $faker->streetAddress(),
                'kecamatan' => $cabang->kecamatan ?? 'Tegal Timur',
                'kelurahan' => $faker->randomElement(['Pekauman', 'Kraton', 'Mangkukusuman', 'Mintaragen', 'Panggung']),
                'tingkat' => $school['tingkat'],
                'jumlah_siswa' => $faker->numberBetween(100, 800),
                'status' => 'Aktif',
                'status_jempol' => 'Belum',
                'cabang_id' => $cabang->id,
                'fokus_layanan' => 'KTP-el'
            ]);
        }
    }
}
