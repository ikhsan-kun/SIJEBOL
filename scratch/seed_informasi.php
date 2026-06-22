<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Informasi;

Informasi::truncate();

Informasi::create([
    'tipe' => 'berita',
    'judul' => 'Disdukcapil Tegal Maksimalkan Layanan Jemput Bola ke Sekolah',
    'slug' => 'disdukcapil-tegal-maksimalkan-layanan-jemput-bola-ke-sekolah',
    'konten' => 'Dalam rangka percepatan kepemilikan KTP elektronik bagi pemula, Disdukcapil Kota Tegal terus menggencarkan program jemput bola ke berbagai sekolah menengah atas.',
    'status' => 'publikasi',
    'created_at' => now()->subDays(2),
]);

Informasi::create([
    'tipe' => 'berita',
    'judul' => 'Warga Tegal Kini Bisa Cetak KK Sendiri di Rumah',
    'slug' => 'warga-tegal-kini-bisa-cetak-kk-sendiri-di-rumah',
    'konten' => 'Kemudahan layanan administrasi kependudukan semakin nyata. Kini warga bisa mencetak Kartu Keluarga secara mandiri menggunakan kertas HVS A4 80 gram.',
    'status' => 'publikasi',
    'created_at' => now()->subDays(5),
]);

Informasi::create([
    'tipe' => 'pengumuman',
    'judul' => 'Penting: Penyesuaian Jam Layanan Selama Bulan Ramadhan',
    'slug' => 'penting-penyesuaian-jam-layanan-selama-bulan-ramadhan',
    'konten' => 'Diberitahukan kepada seluruh warga Kota Tegal, selama bulan suci Ramadhan, pelayanan administrasi kependudukan di kantor Disdukcapil menyesuaikan menjadi pukul 08.00 - 14.30 WIB (Senin-Kamis) dan 08.00 - 11.00 WIB (Jumat).',
    'status' => 'publikasi',
    'created_at' => now()->subDays(10),
]);

Informasi::create([
    'tipe' => 'pengumuman',
    'judul' => 'Informasi: Pemeliharaan Sistem Server SIAK',
    'slug' => 'informasi-pemeliharaan-sistem-server-siak',
    'konten' => 'Sehubungan dengan adanya pemeliharaan jaringan server SIAK Terpusat oleh Kemendagri, layanan cetak KTP-el akan mengalami penundaan pada hari Sabtu, 24 April 2024. Layanan akan kembali normal pada hari Senin.',
    'status' => 'publikasi',
    'created_at' => now()->subDays(12),
]);

echo "Seeded Informasi successfully\n";
