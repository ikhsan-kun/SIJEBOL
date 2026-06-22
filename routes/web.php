<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Session;

Route::get('/seed-master-data', function() {
    \Illuminate\Support\Facades\DB::table('master_kecamatan')->truncate();
    \Illuminate\Support\Facades\DB::table('master_kecamatan')->insert([
        ['kode' => 'KEC-01', 'nama' => 'Tegal Barat', 'keterangan' => 'Kecamatan Tegal Barat', 'status' => 'Aktif'],
        ['kode' => 'KEC-02', 'nama' => 'Tegal Timur', 'keterangan' => 'Kecamatan Tegal Timur', 'status' => 'Aktif'],
        ['kode' => 'KEC-03', 'nama' => 'Tegal Selatan', 'keterangan' => 'Kecamatan Tegal Selatan', 'status' => 'Aktif'],
        ['kode' => 'KEC-04', 'nama' => 'Margadana', 'keterangan' => 'Kecamatan Margadana', 'status' => 'Aktif'],
    ]);
    
    \Illuminate\Support\Facades\Schema::dropIfExists('master_kelurahan');
    \Illuminate\Support\Facades\Schema::create('master_kelurahan', function (\Illuminate\Database\Schema\Blueprint $table) {
        $table->id();
        $table->string('kode', 50)->unique();
        $table->string('nama', 100);
        $table->string('kecamatan_nama', 100);
        $table->string('status', 20)->default('Aktif');
        $table->timestamps();
    });

    \Illuminate\Support\Facades\DB::table('master_kelurahan')->insert([
        // Tegal Barat (7)
        ['kode' => 'KEL-101', 'nama' => 'Tegalsari', 'kecamatan_nama' => 'Tegal Barat', 'status' => 'Aktif'],
        ['kode' => 'KEL-102', 'nama' => 'Kraton', 'kecamatan_nama' => 'Tegal Barat', 'status' => 'Aktif'],
        ['kode' => 'KEL-103', 'nama' => 'Kemandungan', 'kecamatan_nama' => 'Tegal Barat', 'status' => 'Aktif'],
        ['kode' => 'KEL-104', 'nama' => 'Pekauman', 'kecamatan_nama' => 'Tegal Barat', 'status' => 'Aktif'],
        ['kode' => 'KEL-105', 'nama' => 'Pesurungan Kidul', 'kecamatan_nama' => 'Tegal Barat', 'status' => 'Aktif'],
        ['kode' => 'KEL-106', 'nama' => 'Debong Lor', 'kecamatan_nama' => 'Tegal Barat', 'status' => 'Aktif'],
        ['kode' => 'KEL-107', 'nama' => 'Muarareja', 'kecamatan_nama' => 'Tegal Barat', 'status' => 'Aktif'],
        
        // Tegal Timur (5)
        ['kode' => 'KEL-201', 'nama' => 'Panggung', 'kecamatan_nama' => 'Tegal Timur', 'status' => 'Aktif'],
        ['kode' => 'KEL-202', 'nama' => 'Mintaragen', 'kecamatan_nama' => 'Tegal Timur', 'status' => 'Aktif'],
        ['kode' => 'KEL-203', 'nama' => 'Kejambon', 'kecamatan_nama' => 'Tegal Timur', 'status' => 'Aktif'],
        ['kode' => 'KEL-204', 'nama' => 'Slerok', 'kecamatan_nama' => 'Tegal Timur', 'status' => 'Aktif'],
        ['kode' => 'KEL-205', 'nama' => 'Mangkukusuman', 'kecamatan_nama' => 'Tegal Timur', 'status' => 'Aktif'],
        
        // Tegal Selatan (8)
        ['kode' => 'KEL-301', 'nama' => 'Bandung', 'kecamatan_nama' => 'Tegal Selatan', 'status' => 'Aktif'],
        ['kode' => 'KEL-302', 'nama' => 'Debong Kidul', 'kecamatan_nama' => 'Tegal Selatan', 'status' => 'Aktif'],
        ['kode' => 'KEL-303', 'nama' => 'Debong Kulon', 'kecamatan_nama' => 'Tegal Selatan', 'status' => 'Aktif'],
        ['kode' => 'KEL-304', 'nama' => 'Debong Tengah', 'kecamatan_nama' => 'Tegal Selatan', 'status' => 'Aktif'],
        ['kode' => 'KEL-305', 'nama' => 'Kalinyamat Wetan', 'kecamatan_nama' => 'Tegal Selatan', 'status' => 'Aktif'],
        ['kode' => 'KEL-306', 'nama' => 'Keturen', 'kecamatan_nama' => 'Tegal Selatan', 'status' => 'Aktif'],
        ['kode' => 'KEL-307', 'nama' => 'Randugunting', 'kecamatan_nama' => 'Tegal Selatan', 'status' => 'Aktif'],
        ['kode' => 'KEL-308', 'nama' => 'Tunon', 'kecamatan_nama' => 'Tegal Selatan', 'status' => 'Aktif'],
        
        // Margadana (7)
        ['kode' => 'KEL-401', 'nama' => 'Cabawan', 'kecamatan_nama' => 'Margadana', 'status' => 'Aktif'],
        ['kode' => 'KEL-402', 'nama' => 'Kaligangsa', 'kecamatan_nama' => 'Margadana', 'status' => 'Aktif'],
        ['kode' => 'KEL-403', 'nama' => 'Kalinyamat Kulon', 'kecamatan_nama' => 'Margadana', 'status' => 'Aktif'],
        ['kode' => 'KEL-404', 'nama' => 'Krandon', 'kecamatan_nama' => 'Margadana', 'status' => 'Aktif'],
        ['kode' => 'KEL-405', 'nama' => 'Margadana', 'kecamatan_nama' => 'Margadana', 'status' => 'Aktif'],
        ['kode' => 'KEL-406', 'nama' => 'Pesurungan Lor', 'kecamatan_nama' => 'Margadana', 'status' => 'Aktif'],
        ['kode' => 'KEL-407', 'nama' => 'Sumurpanggang', 'kecamatan_nama' => 'Margadana', 'status' => 'Aktif'],
    ]);

    \Illuminate\Support\Facades\Schema::dropIfExists('master_jenis_layanan');
    \Illuminate\Support\Facades\Schema::create('master_jenis_layanan', function (\Illuminate\Database\Schema\Blueprint $table) {
        $table->id();
        $table->string('kode', 50)->unique();
        $table->string('nama', 100);
        $table->text('deskripsi')->nullable();
        $table->string('status', 20)->default('Aktif');
        $table->timestamps();
    });

    \Illuminate\Support\Facades\DB::table('master_jenis_layanan')->insert([
        ['kode' => 'JL001', 'nama' => 'KTP-el', 'deskripsi' => 'Layanan penerbitan Kartu Tanda Penduduk Elektronik', 'status' => 'Aktif'],
        ['kode' => 'JL002', 'nama' => 'IKD', 'deskripsi' => 'Layanan Identitas Kependudukan Digital', 'status' => 'Aktif'],
        ['kode' => 'JL003', 'nama' => 'KIA', 'deskripsi' => 'Layanan Kartu Identitas Anak', 'status' => 'Aktif'],
    ]);

    return "Data awal berhasil diisi!";
});

Route::get('/run-master-data-migration', function() {
    try {
        if (!\Illuminate\Support\Facades\Schema::hasTable('master_kecamatan')) {
            \Illuminate\Support\Facades\Schema::create('master_kecamatan', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->id();
                $table->string('kode', 50)->unique();
                $table->string('nama', 100);
                $table->text('keterangan')->nullable();
                $table->string('status', 20)->default('Aktif');
                $table->timestamps();
            });
        }
        if (!\Illuminate\Support\Facades\Schema::hasTable('master_kelurahan')) {
            \Illuminate\Support\Facades\Schema::create('master_kelurahan', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->id();
                $table->string('kode', 50)->unique();
                $table->string('nama', 100);
                $table->string('kecamatan_nama', 100);
                $table->string('status', 20)->default('Aktif');
                $table->timestamps();
            });
        }
        if (!\Illuminate\Support\Facades\Schema::hasTable('master_jenis_layanan')) {
            \Illuminate\Support\Facades\Schema::create('master_jenis_layanan', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->id();
                $table->string('kode', 50)->unique();
                $table->string('nama', 100);
                $table->text('deskripsi')->nullable();
                $table->string('status', 20)->default('Aktif');
                $table->timestamps();
            });
        }
        if (!\Illuminate\Support\Facades\Schema::hasTable('master_status_layanan')) {
            \Illuminate\Support\Facades\Schema::create('master_status_layanan', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->id();
                $table->string('kode', 50)->unique();
                $table->string('nama', 100);
                $table->string('warna', 50)->default('blue');
                $table->text('deskripsi')->nullable();
                $table->timestamps();
            });
            
            // Insert default data for status
            \Illuminate\Support\Facades\DB::table('master_status_layanan')->insert([
                ['kode' => 'STS-1', 'nama' => 'Menunggu Verifikasi', 'warna' => 'Kuning', 'deskripsi' => 'Berkas masuk dan menunggu pengecekan awal'],
                ['kode' => 'STS-2', 'nama' => 'Diproses', 'warna' => 'Biru', 'deskripsi' => 'Berkas valid dan sedang dikerjakan'],
                ['kode' => 'STS-3', 'nama' => 'Selesai', 'warna' => 'Hijau', 'deskripsi' => 'Layanan telah selesai diproses'],
                ['kode' => 'STS-4', 'nama' => 'Ditolak', 'warna' => 'Merah', 'deskripsi' => 'Berkas tidak valid atau ditolak']
            ]);
        }
        
        return "Migrasi Master Data Berhasil!";
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

Route::get('/run-school-migration', function() {
    try {
        $db = \Illuminate\Support\Facades\DB::connection()->getPdo();
        if (!\Illuminate\Support\Facades\Schema::hasTable('schools')) {
            \Illuminate\Support\Facades\Schema::create('schools', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->id();
                $table->string('npsn', 50)->nullable();
                $table->string('nama_sekolah', 200);
                $table->text('alamat')->nullable();
                $table->string('kecamatan', 100)->nullable();
                $table->string('kelurahan', 100)->nullable();
                $table->string('tingkat', 50)->nullable();
                $table->integer('jumlah_siswa')->default(0);
                $table->string('status', 50)->default('Swasta');
                $table->string('status_jempol', 50)->nullable();
                $table->string('fokus_layanan', 100)->nullable()->default('KTP-el');
                $table->integer('cabang_id')->nullable();
                $table->timestamps();
            });
        }

        $cols = \Illuminate\Support\Facades\Schema::getColumnListing('schools');
        if (!in_array('kelurahan', $cols)) {
            $db->exec("ALTER TABLE schools ADD COLUMN kelurahan VARCHAR(255) NULL AFTER kecamatan");
        }
        if (!in_array('status', $cols)) {
            $db->exec("ALTER TABLE schools ADD COLUMN status VARCHAR(50) NULL DEFAULT 'Swasta' AFTER kelurahan");
        }
        if (!in_array('fokus_layanan', $cols)) {
            $db->exec("ALTER TABLE schools ADD COLUMN fokus_layanan VARCHAR(100) NULL DEFAULT 'KTP-el' AFTER status");
        }

        // 2. Data 20 sekolah (insert/update langsung via raw SQL)
        $rows = [
            ['69743498','RA/BA/TA AT TAQWA',               'JL KELAPA SAWIT NO 3',                   'Tegal Barat',   'Pekauman',    45],
            ['20360241','TK AISYIYAH BUSTANUL ATHFAL VIII', 'JL. ASEMTIGA GG. V NO.11 RT 08 RW 03',  'Tegal Barat',   'Kraton',      62],
            ['20351667','TK AL KHAIRIYYAH',                 'JL. GANDARIA NO.2 RT 09 RW 01',          'Tegal Barat',   'Kraton',      38],
            ['20351661','TK AL-IRSYAD AL-ISLAMIYAH',        'JL. GAJAHMADA NO. 114 TEGAL',            'Tegal Barat',   'Pekauman',    75],
            ['20351669','TK ASSYIFA',                       'JL. SIWALAN NO. 1 RT 04 RW 07',          'Tegal Barat',   'Kraton',      54],
            ['20351657','TK BAGYA WACANA',                  'JL. DR. SUTOMO NO. 35',                  'Tegal Barat',   'Pekauman',    41],
            ['20351658','TK ELKANA',                        'JL. KAPTEN ISMAIL NO.123 A',              'Tegal Barat',   'Kraton',      33],
            ['69960276','TK GLOBAL INBYRA SCHOOL',          'JL. KOMPOL SUPRAPTO NO. 8',               'Tegal Barat',   'Kemandungan', 28],
            ['20351660','TK HANG TUAH 16',                  'JL. YOS SUDARSO',                        'Tegal Barat',   'Mintaragen',  49],
            ['20351655','TK PIUS',                          'JL. KAPTEN ISMAIL NO.120',                'Tegal Barat',   'Kraton',      57],
            ['69818043','KB AL-IRSYAD',                     'JL. GAJAH MADA NO.114',                  'Tegal Barat',   'Pekauman',    30],
            ['69818061','KB AT-TAQWA',                      'JL. KELAPA SAWIT NO.15',                 'Tegal Barat',   'Pekauman',    22],
            ['69818065','KB AZZUROFAH',                     'JL. SALAK NO.115',                       'Tegal Barat',   'Pekauman',    18],
            ['69818088','KB BINA ANAK SHOLEH (BIAS)',       'JL. SIPELEM',                            'Tegal Barat',   'Kemandungan', 25],
            ['69918017','KB ELFATH KIDS',                   'JL. NANAS 116',                          'Tegal Barat',   'Pekauman',    20],
            ['69818045','KB ELKANA',                        'JL. KAPTEN ISMAIL NO.123 A',              'Tegal Barat',   'Kraton',      17],
            ['69958134','HIDAYATUL MUBTADIIEN',              'JL. MERPATI GG. KASWARI',                'Tegal Selatan', 'Randugunting',35],
            ['69743499','RA/BA/TA BAITUSH SHOBIRIN',         'JL. NYI AGENG SERANG',                   'Tegal Selatan', 'Tunon',       42],
            ['69743500','RA/BA/TA BIAS ASSALAM',             'JL. DADALI NO.12',                       'Tegal Selatan', 'Randugunting',38],
            ['20350569','TK AISYIYAH BUSTANUL ATHFAL II',   'JL. MERPATI NO.90',                      'Tegal Selatan', 'Randugunting',56],
        ];

        // Cari cabang_id untuk tiap kecamatan
        $cabangMap = [];
        $petugasList = \Illuminate\Support\Facades\DB::table('users')->where('role','cabang')->get(['id','kecamatan']);
        foreach ($petugasList as $p) { $cabangMap[$p->kecamatan] = $p->id; }
        $adminId = \Illuminate\Support\Facades\DB::table('users')->where('role','admin')->value('id') ?? 1;

        $inserted = 0; $updated = 0;
        $now = date('Y-m-d H:i:s');
        foreach ($rows as [$npsn, $nama, $alamat, $kecamatan, $kelurahan, $siswa]) {
            $cabangId = $cabangMap[$kecamatan] ?? $adminId;
            $exists = \Illuminate\Support\Facades\DB::table('schools')->where('npsn', $npsn)->first();
            if ($exists) {
                \Illuminate\Support\Facades\DB::table('schools')->where('npsn', $npsn)->update([
                    'nama_sekolah'  => $nama,
                    'alamat'        => $alamat,
                    'kecamatan'     => $kecamatan,
                    'kelurahan'     => $kelurahan,
                    'jumlah_siswa'  => $siswa,
                    'status'        => 'Swasta',
                    'cabang_id'     => $cabangId,
                    'updated_at'    => $now,
                ]);
                $updated++;
            } else {
                \Illuminate\Support\Facades\DB::table('schools')->insert([
                    'npsn'          => $npsn,
                    'nama_sekolah'  => $nama,
                    'alamat'        => $alamat,
                    'kecamatan'     => $kecamatan,
                    'kelurahan'     => $kelurahan,
                    'tingkat'       => 'TK',
                    'jumlah_siswa'  => $siswa,
                    'status'        => 'Swasta',
                    'status_jempol' => 'Belum',
                    'cabang_id'     => $cabangId,
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ]);
                $inserted++;
            }
        }

        $total = \Illuminate\Support\Facades\DB::table('schools')->count();
        return '<div style="font-family:sans-serif;padding:30px;max-width:500px">
            <h2 style="color:green">✅ Berhasil!</h2>
            <p><b>' . $inserted . '</b> sekolah ditambahkan baru</p>
            <p><b>' . $updated . '</b> sekolah diperbarui</p>
            <p>Total sekolah di database: <b>' . $total . '</b></p>
            <br>
            <a href="/cabang/sekolah" style="background:#003178;color:white;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:bold">→ Lihat Halaman Sekolah</a>
        </div>';
    } catch (\Exception $e) {
        return '<div style="font-family:sans-serif;padding:20px;color:red"><h2>❌ Error</h2><pre style="background:#fee;padding:10px">' . $e->getMessage() . '</pre></div>';
    }
});


Route::get('/debug-sekolah', function() {
    $users   = \App\Models\User::whereIn('role', ['cabang', 'cabang_dinas', 'petugas', 'petugas cabang', 'petugas kecamatan'])->select('id','name','kecamatan')->get();
    $schools = \Illuminate\Support\Facades\DB::table('schools')->get();
    $cols    = \Illuminate\Support\Facades\Schema::getColumnListing('schools');
    
    $out = "KOLOM: " . implode(', ', $cols) . "\n\n";
    $out .= "TOTAL SEKOLAH: " . $schools->count() . "\n\n";
    foreach ($schools as $s) {
        $out .= "ID: {$s->id} | NPSN: " . ($s->npsn ?? '-') . " | NAMA: {$s->nama_sekolah} | KEC: {$s->kecamatan} | KEL: " . ($s->kelurahan ?? '-') . " | STATUS: " . ($s->status ?? '-') . " | SISWA: {$s->jumlah_siswa}\n";
    }
    $out .= "\nPETUGAS:\n";
    foreach ($users as $u) {
        $out .= "ID: {$u->id} | NAMA: {$u->name} | KEC: {$u->kecamatan}\n";
    }
    return response($out)->header('Content-Type', 'text/plain');
});

Route::get('/fix-data', function() {
    $map = [
        'tegal_timur' => 'Tegal Timur',
        'tegal_barat' => 'Tegal Barat',
        'tegal_selatan' => 'Tegal Selatan',
        'margadana' => 'Margadana'
    ];

    foreach($map as $old => $new) {
        \App\Models\Masyarakat::where('kecamatan', $old)->update(['kecamatan' => $new]);
        \App\Models\PengajuanLayanan::where('kecamatan', $old)->update(['kecamatan' => $new]);
    }

    // Pastikan yang punya nama sekolah tipenya benar-benar 'sekolah'
    \App\Models\Masyarakat::whereNotNull('school')->where('school', '!=', '')->update(['location_type' => 'sekolah']);

    return "Data updated successfully! Silakan cek kembali monitoring cabang.";
});

Route::get('/add-columns', function() {
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    if (function_exists('opcache_reset')) {
        opcache_reset();
    }
    return "Cache and OPCache cleared!";
});

Route::get('/fix-missing-schools', function() {
    $users = \App\Models\Masyarakat::whereNotNull('school')->get();
    $debug = [];
    
    foreach ($users as $user) {
        $school = \App\Models\School::where('nama_sekolah', $user->school)->first();
        $debug[] = [
            'user_school' => $user->school,
            'exists_in_school' => $school ? true : false,
            'location_type' => $user->location_type
        ];
    }
    return response()->json($debug);
});

Route::get('/debug-targets', function() {
    try {
        $hasTable = \Illuminate\Support\Facades\Schema::hasTable('regional_targets');
        $cols = $hasTable ? \Illuminate\Support\Facades\Schema::getColumnListing('regional_targets') : [];
        $data = $hasTable ? \Illuminate\Support\Facades\DB::table('regional_targets')->get() : [];
        return response()->json([
            'hasTable' => $hasTable,
            'columns' => $cols,
            'data' => $data
        ]);
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});


Route::get('/force-seed-targets', function() {
    try {
        $schema = \Illuminate\Support\Facades\Schema::getConnection()->getSchemaBuilder();
        if ($schema->hasTable('regional_targets')) {
            $schema->drop('regional_targets');
        }

        $schema->create('regional_targets', function ($table) {
            $table->id();
            $table->string('kecamatan');
            $table->string('kelurahan')->nullable();
            $table->integer('target_ktp')->default(0);
            $table->integer('target_kia')->default(0);
            $table->integer('target_ikd')->default(0);
            $table->timestamps();
        });

        // Seed data kecamatan dan kelurahan Kota Tegal
        $kecamatans = [
            'TEGAL BARAT' => ['PESURUNGAN KIDUL', 'DEBONG LOR', 'KEMANDUNGAN', 'PEKAUMAN', 'KRATON', 'TEGALSARI', 'MUARAREJA'],
            'TEGAL TIMUR' => ['SLEROK', 'PANGGUNG', 'MANGKUKUSUMAN', 'KEJAMBON', 'MINTARAGEN'],
            'TEGAL SELATAN' => ['RANDUGUNTING', 'TUNON', 'BANDUNG', 'DEBONG KIDUL', 'DEBONG KULON', 'DEBONG TENGAH', 'KETUREN'],
            'MARGADANA' => ['MARGADANA', 'CABAWAN', 'KALIGANGSA', 'KRANGDON', 'PESURUNGAN LOR', 'SUMURPANGGANG'],
        ];

        foreach ($kecamatans as $kec => $kelurahans) {
            // Seed Kecamatan target
            \Illuminate\Support\Facades\DB::table('regional_targets')->insert([
                'kecamatan' => $kec,
                'kelurahan' => null,
                'target_ktp' => 0,
                'target_kia' => 0,
                'target_ikd' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Seed Kelurahan targets
            foreach ($kelurahans as $kel) {
                \Illuminate\Support\Facades\DB::table('regional_targets')->insert([
                    'kecamatan' => $kec,
                    'kelurahan' => $kel,
                    'target_ktp' => 0,
                    'target_kia' => 0,
                    'target_ikd' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        return "SUCCESS FORCE SEED TARGETS";
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});

Route::get('/run-settings-migration', function() {
    try {
        $db = \Illuminate\Support\Facades\DB::connection()->getPdo();
        $schema = \Illuminate\Support\Facades\Schema::getConnection()->getSchemaBuilder();

        // 0. Add agency_logo
        if (!$schema->hasColumn('app_settings', 'agency_logo')) {
            $db->exec("ALTER TABLE app_settings ADD COLUMN agency_logo VARCHAR(255) NULL");
        }

        // 1. Tambah tabel regions jika belum ada
        if (!$schema->hasTable('regions')) {
            $schema->create('regions', function ($table) {
                $table->id();
                $table->string('kecamatan');
                $table->string('kelurahan');
                $table->timestamps();
            });

            // Seed initial data
            $kecamatans = [
                'Tegal Barat' => ['Pekauman', 'Kraton', 'Kemandungan', 'Mintaragen', 'Pesurungan Kidul', 'Tegalsari', 'Muara Anyar'],
                'Tegal Timur' => ['Slerok', 'Panggung', 'Mangkukusuman', 'Kejambon', 'Mintaragen'],
                'Tegal Selatan' => ['Randugunting', 'Tunon', 'Bandung', 'Debong Kidul', 'Debong Kulon', 'Debong Tengah', 'Keturen'],
                'Margadana' => ['Margadana', 'Cabawan', 'Kaligangsa', 'Krangdon', 'Pesurungan Lor', 'Sumurpanggang'],
            ];

            foreach ($kecamatans as $kec => $kelurahans) {
                foreach ($kelurahans as $kel) {
                    \Illuminate\Support\Facades\DB::table('regions')->insert([
                        'kecamatan' => $kec,
                        'kelurahan' => $kel,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        // 2. Update tabel app_settings dengan kolom baru
        $cols = $schema->getColumnListing('app_settings');
        if (!in_array('operational_hours', $cols)) {
            $db->exec("ALTER TABLE app_settings ADD COLUMN operational_hours TEXT NULL");
        }
        if (!in_array('notification_settings', $cols)) {
            $db->exec("ALTER TABLE app_settings ADD COLUMN notification_settings TEXT NULL");
        }
        if (!in_array('document_templates', $cols)) {
            $db->exec("ALTER TABLE app_settings ADD COLUMN document_templates TEXT NULL");
        }

        // Set default values if empty
        $settings = \Illuminate\Support\Facades\DB::table('app_settings')->first();
        if ($settings) {
            \Illuminate\Support\Facades\DB::table('app_settings')->update([
                'operational_hours' => $settings->operational_hours ?? json_encode([
                    'senin_kamis' => '08:00 - 15:00',
                    'jumat' => '08:00 - 11:00',
                    'sabtu' => 'Tutup',
                    'minggu' => 'Tutup'
                ]),
                'notification_settings' => $settings->notification_settings ?? json_encode([
                    'email_pengajuan_baru' => true,
                    'email_perubahan_jadwal' => true,
                    'sms_notifikasi' => false
                ]),
                'document_templates' => $settings->document_templates ?? json_encode([
                    'kop_surat' => null,
                    'stempel' => null
                ])
            ]);
        } else {
            \Illuminate\Support\Facades\DB::table('app_settings')->insert([
                'agency_name' => 'Dinas Kependudukan dan Pencatatan Sipil',
                'work_region' => 'Pemerintah Kota Tegal',
                'address' => 'Jl. Lele No. 14, Kota Tegal',
                'operational_hours' => json_encode([
                    'senin_kamis' => '08:00 - 15:00',
                    'jumat' => '08:00 - 11:00',
                    'sabtu' => 'Tutup',
                    'minggu' => 'Tutup'
                ]),
                'notification_settings' => json_encode([
                    'email_pengajuan_baru' => true,
                    'email_perubahan_jadwal' => true,
                    'sms_notifikasi' => false
                ]),
                'document_templates' => json_encode([
                    'kop_surat' => null,
                    'stempel' => null
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 3. Tambah tabel regional_targets jika belum ada (atau drop dan recreate jika perlu)
        if ($schema->hasTable('regional_targets')) {
            $schema->drop('regional_targets');
        }
        
        if (!$schema->hasTable('regional_targets')) {
            $schema->create('regional_targets', function ($table) {
                $table->id();
                $table->string('kecamatan');
                $table->string('kelurahan')->nullable();
                $table->integer('target_ktp')->default(0);
                $table->integer('target_kia')->default(0);
                $table->integer('target_ikd')->default(0);
                $table->timestamps();
            });

            // Seed data kecamatan dan kelurahan Kota Tegal
            $kecamatans = [
                'TEGAL BARAT' => ['PESURUNGAN KIDUL', 'DEBONG LOR', 'KEMANDUNGAN', 'PEKAUMAN', 'KRATON', 'TEGALSARI', 'MUARAREJA'],
                'TEGAL TIMUR' => ['SLEROK', 'PANGGUNG', 'MANGKUKUSUMAN', 'KEJAMBON', 'MINTARAGEN'],
                'TEGAL SELATAN' => ['RANDUGUNTING', 'TUNON', 'BANDUNG', 'DEBONG KIDUL', 'DEBONG KULON', 'DEBONG TENGAH', 'KETUREN'],
                'MARGADANA' => ['MARGADANA', 'CABAWAN', 'KALIGANGSA', 'KRANGDON', 'PESURUNGAN LOR', 'SUMURPANGGANG'],
            ];

            foreach ($kecamatans as $kec => $kelurahans) {
                // Seed Kecamatan target
                \Illuminate\Support\Facades\DB::table('regional_targets')->insert([
                    'kecamatan' => $kec,
                    'kelurahan' => null,
                    'target_ktp' => 0,
                    'target_kia' => 0,
                    'target_ikd' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Seed Kelurahan targets
                foreach ($kelurahans as $kel) {
                    \Illuminate\Support\Facades\DB::table('regional_targets')->insert([
                        'kecamatan' => $kec,
                        'kelurahan' => $kel,
                        'target_ktp' => 0,
                        'target_kia' => 0,
                        'target_ikd' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        return '<div style="font-family:sans-serif;padding:30px;max-width:500px">
            <h2 style="color:green">✅ Migrasi Pengaturan Berhasil!</h2>
            <p>Tabel Wilayah, Regional Targets, dan kolom pengaturan tambahan telah ditambahkan ke database.</p>
            <br>
            <a href="/admin/settings" style="background:#003178;color:white;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:bold">→ Kembali ke Pengaturan</a>
        </div>';
    } catch (\Exception $e) {
        return '<div style="font-family:sans-serif;padding:20px;color:red"><h2>❌ Error</h2><pre style="background:#fee;padding:10px">' . $e->getMessage() . '</pre></div>';
    }
});


/*
|--------------------------------------------------------------------------
| 1. SISTEM SETUP & AUTHENTICATION
|--------------------------------------------------------------------------
*/

// Setup Awal (Hapus setelah produksi)
Route::get('/setup-admin', function () {
    try {
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@jebol.com'],
            [
                'name' => 'Admin Pusat SI JEBOL',
                'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
                'role' => 'admin',
                'nik' => '1234567890123456',
                'phone' => '08123456789',
                'location_type' => 'pusat'
            ]
        );
        
        \App\Models\User::updateOrCreate(
            ['email' => 'petugas@jebol.com'],
            [
                'name' => 'Budi Pratama (Petugas Tegal Barat)',
                'password' => \Illuminate\Support\Facades\Hash::make('petugas123'),
                'role' => 'petugas',
                'nik' => '3328010101010001',
                'phone' => '082233445566',
                'location_type' => 'kecamatan',
                'kecamatan' => 'Tegal Barat'
            ]
        );

        return redirect()->route('admin.login')->with('status', 'Akun Admin (1234567890123456) & Cabang (3328010101010001) Siap Digunakan!');
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

// TEMPORARY FIX
Route::get('/reset-admin', function () {
    $admin = \App\Models\User::where('nik', '1234567890123456')->first();
    if ($admin) {
        $admin->password = \Illuminate\Support\Facades\Hash::make('admin123');
        $admin->save();
        return "Password Admin telah di-reset menjadi: admin123";
    }
    return "Admin tidak ditemukan";
});

// Unified Login Route (Admin, Cabang/Petugas, and Warga/Masyarakat)
Route::get('/login', function () {
    if (Auth::guard('admin')->check()) {
        $role = trim(strtolower(Auth::guard('admin')->user()->role ?? ''));
        if (in_array($role, ['admin', 'admin pusat'])) {
            return redirect()->route('admin.dashboard');
        } elseif (in_array($role, ['cabang', 'cabang_dinas', 'petugas', 'petugas cabang', 'petugas kecamatan'])) {
            return redirect()->route('cabang.dashboard');
        }
    }
    if (Auth::guard('masyarakat')->check()) {
        return redirect()->route('masyarakat.dashboard');
    }
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'nik' => 'required',
        'password' => 'required',
    ]);

    // 1. Check in User table (admin & cabang/petugas)
    $adminUser = \App\Models\User::where('nik', $credentials['nik'])->first();
    if ($adminUser && Hash::check($credentials['password'], $adminUser->password)) {
        Auth::guard('admin')->login($adminUser);
        $request->session()->regenerate();
        $request->session()->save();

        $role = trim(strtolower($adminUser->role ?? ''));
        if (in_array($role, ['admin', 'admin pusat'])) {
            return redirect()->route('admin.dashboard');
        } elseif (in_array($role, ['cabang', 'cabang_dinas', 'petugas', 'petugas cabang', 'petugas kecamatan'])) {
            return redirect()->route('cabang.dashboard');
        }
    }

    // 2. Check in Masyarakat table (warga / sekolah)
    if (Auth::guard('masyarakat')->attempt(['nik' => $credentials['nik'], 'password' => $credentials['password']])) {
        $request->session()->regenerate();
        $request->session()->save();
        return redirect()->route('masyarakat.dashboard');
    }

    return back()->withErrors(['nik' => 'NIK atau password salah.'])->withInput($request->only('nik'));
})->name('login.post');

// Backwards compatibility / alias redirects for old login pages
Route::get('/jebolkotategal', function () {
    return redirect()->route('login');
})->name('admin.login');

Route::get('/jebolcabang', function () {
    return redirect()->route('login');
})->name('cabang.login');

// Logout Global
Route::post('/logout', function () {
    if (Auth::guard('admin')->check()) {
        Auth::guard('admin')->logout();
    } else {
        Auth::guard('masyarakat')->logout();
    }
    return redirect()->route('login');
})->name('logout');


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| 2. KELOMPOK MASYARAKAT (PUBLIC & CITIZEN)
|--------------------------------------------------------------------------
*/

Route::get('/debug-db', function() {
    $p1 = \App\Models\PengajuanLayanan::whereHas('user', function($q) {
        $q->where('location_type', 'sekolah');
    })->count();
    $p2 = \App\Models\PengajuanLayanan::whereHas('masyarakat', function($q) {
        $q->whereNotNull('sekolah');
    })->count();
    $u1 = \App\Models\User::where('location_type', 'sekolah')->count();
    $u2 = \App\Models\User::whereNotNull('school')->count();
    
    return response()->json([
        'p_location_type_sekolah' => $p1,
        'p_masyarakat_sekolah' => $p2,
        'u_location_type_sekolah' => $u1,
        'u_school_not_null' => $u2,
    ]);
});

Route::get('/', function () { 
    $services = \Illuminate\Support\Facades\DB::table('master_jenis_layanan')->where('status', 'Aktif')->get();
    $recentReviews = \App\Models\KepuasanWarga::with('masyarakat')->whereNotNull('kritik_saran')->where('nilai_kepuasan', '>=', 4)->orderBy('tanggal_input', 'desc')->take(3)->get();
    
    $totalServices = $services->count();
    $dokumenTerbit = \Illuminate\Support\Facades\DB::table('pengajuan_layanan')->where('status', 'selesai')->count();
    $avgKepuasan = \App\Models\KepuasanWarga::avg('nilai_kepuasan') ?? 0;
    $persenKepuasan = $avgKepuasan > 0 ? round(($avgKepuasan / 5) * 100) : 0;

    return view('pengunjung.beranda', compact('services', 'recentReviews', 'totalServices', 'dokumenTerbit', 'persenKepuasan')); 
})->name('home');
Route::get('/kontak', function () { return view('pengunjung.kontak'); })->name('contact');
Route::get('/tentang', function () { return view('pengunjung.tentang'); })->name('tentang');
Route::get('/bantuan', function () { return view('pengunjung.bantuan'); })->name('bantuan');
Route::get('/layanan', function () { 
    $services = \Illuminate\Support\Facades\DB::table('master_jenis_layanan')->where('status', 'Aktif')->get();
    return view('pengunjung.layanan', compact('services')); 
})->name('services');
Route::get('/jadwal', [App\Http\Controllers\JadwalController::class, 'publicIndex'])->name('jadwal');
Route::get('/lokasi', function () {
    return view('pengunjung.lokasi');
})->name('location');



Route::get('/generate-test-school', function() {
    $detailPengajuan = json_encode([
        'usulan_tanggal' => '2026-06-15',
        'usulan_jam_mulai' => '08:00',
        'usulan_jam_selesai' => '12:00',
        'kategori_layanan' => 'KTP-el',
    ]);
    
    \App\Models\PengajuanLayanan::create([
        'nik' => '3376' . rand(100000, 999999) . rand(100000, 999999),
        'nomor_tiket' => 'JB-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(4)),
        'jenis_layanan' => 'KTP-el',
        'jenis_pengajuan' => 'Sekolah',
        'tanggal_pengajuan' => now(),
        'alamat' => 'Jl. Pendidikan No 1',
        'lokasi_pelayanan' => 'Sekolah SMAN 1 Tegal',
        'keterangan' => 'Mohon dijadwalkan perekaman E-KTP untuk siswa kelas 12',
        'detail_pengajuan' => $detailPengajuan,
        'status' => 'menunggu_verifikasi',
    ]);
    return 'Data sekolah berhasil dibuat!';
});

Route::get('/ulasan', function (Illuminate\Http\Request $request) {
    $query = \App\Models\KepuasanWarga::with('masyarakat')->whereNotNull('kritik_saran');
    
    if ($request->filter == '5-bintang') {
        $query->where('nilai_kepuasan', 5);
    } elseif ($request->filter == '4-bintang') {
        $query->where('nilai_kepuasan', 4);
    } elseif ($request->filter == '3-bintang') {
        $query->where('nilai_kepuasan', 3);
    } elseif ($request->filter == '2-bintang') {
        $query->where('nilai_kepuasan', 2);
    } elseif ($request->filter == '1-bintang') {
        $query->where('nilai_kepuasan', 1);
    } elseif ($request->filter == 'ktp') {
        $query->where('saran', 'LIKE', '%KTP%');
    } elseif ($request->filter == 'kia') {
        $query->where('saran', 'LIKE', '%KIA%');
    }

    if ($request->sort == 'tertinggi') {
        $query->orderBy('nilai_kepuasan', 'desc')->orderBy('tanggal_input', 'desc');
    } elseif ($request->sort == 'terlama') {
        $query->orderBy('tanggal_input', 'asc');
    } else {
        $query->orderBy('tanggal_input', 'desc');
    }

    $reviews = $query->paginate(12)->withQueryString();
    
    // Stats calculation
    $totalUlasan = \App\Models\KepuasanWarga::count();
    $rataRata = $totalUlasan > 0 ? \App\Models\KepuasanWarga::avg('nilai_kepuasan') : 0;
    $puasCount = \App\Models\KepuasanWarga::where('nilai_kepuasan', '>=', 4)->count();
    $persentasePuas = $totalUlasan > 0 ? round(($puasCount / $totalUlasan) * 100) : 0;

    return view('pengunjung.ulasan', compact('reviews', 'totalUlasan', 'rataRata', 'persentasePuas'));
})->name('ulasan');

// Auth Masyarakat
Route::get('/register', function () { return view('auth.register'); })->name('register')->middleware('guest');
Route::post('/register', function (Request $request) {
    $data = $request->validate([
        'name'                  => 'required|string|max:255',
        'nik'                   => 'required|digits:16|starts_with:3376|unique:masyarakat,nik',
        'email'                 => 'required|email|unique:masyarakat,email|ends_with:@gmail.com',
        'phone'                 => 'required|starts_with:08',
        'password'              => 'required|min:4|confirmed',
        'terms'                 => 'accepted',
        'tipe_pendaftar'        => 'required|in:kecamatan,sekolah',
        'kecamatan'             => 'required_if:tipe_pendaftar,kecamatan|nullable|string|max:100',
        'nama_sekolah'          => 'required_if:tipe_pendaftar,sekolah|nullable|string|max:255',
        'alamat'                => 'nullable|string|max:500',
    ], [
        'nik.digits'            => 'NIK harus berjumlah 16 digit angka',
        'nik.starts_with'       => 'NIK harus diawali dengan 3376 (Kota Tegal)',
        'nik.unique'            => 'NIK sudah terdaftar. Silakan login.',
        'email.ends_with'       => 'Email harus menggunakan @gmail.com',
        'email.unique'          => 'Email sudah terdaftar. Silakan login.',
        'phone.starts_with'     => 'Nomor HP harus diawali dengan 08',
        'password.confirmed'    => 'Konfirmasi password tidak cocok',
        'terms.accepted'        => 'Anda harus menyetujui Syarat & Ketentuan untuk mendaftar',
        'kecamatan.required_if' => 'Pilihan kecamatan wajib diisi jika mendaftar sebagai warga kecamatan',
        'nama_sekolah.required_if' => 'Nama sekolah wajib diisi jika mendaftar sebagai perwakilan sekolah',
    ]);

    \Illuminate\Support\Facades\DB::transaction(function () use ($data) {
        \App\Models\Masyarakat::create([
            'nama'            => $data['name'],
            'nik'             => $data['nik'],
            'email'           => $data['email'],
            'no_hp'           => $data['phone'],
            'password'        => \Illuminate\Support\Facades\Hash::make($data['password']),
            'alamat'          => $data['alamat'] ?? null,
            'tipe_pendaftar'  => $data['tipe_pendaftar'],
            'school'          => $data['tipe_pendaftar'] === 'sekolah' ? ($data['nama_sekolah'] ?? null) : null,
            'kecamatan'       => $data['tipe_pendaftar'] === 'kecamatan' ? ($data['kecamatan'] ?? null) : null,
        ]);
    });

    return redirect()->route('login')->with('status', 'Akun berhasil dibuat! Silakan login.');
});

Route::get('/register/login', function () {
    return redirect()->route('login');
});
Route::post('/register/login', function () {
    return redirect()->route('login');
});

// Lupa Password (Verifikasi via NIK & Email)
Route::get('/password/reset', function () { 
    return view('auth.forgot-password'); 
})->name('password.request')->middleware('guest');

Route::post('/password/verify', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'nik' => 'required'
    ], [
        'email.required' => 'Email wajib diisi.',
        'nik.required' => 'NIK wajib diisi.'
    ]);

    $user = \App\Models\Masyarakat::where('email', $request->email)->where('nik', $request->nik)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Data NIK dan Email tidak ditemukan atau tidak cocok.'])->withInput();
    }

    // Set session untuk diizinkan ganti password
    session(['reset_email' => $user->email]);

    return redirect()->route('password.reset.form')->with('status', 'Data terverifikasi. Silakan masukkan password baru Anda.');
})->name('password.verify');

Route::get('/password/reset-form', function () {
    if (!session()->has('reset_email')) {
        return redirect()->route('password.request')->withErrors(['email' => 'Sesi tidak valid atau telah habis, silakan ulangi proses.']);
    }
    return view('auth.reset-password', ['email' => session('reset_email')]);
})->name('password.reset.form')->middleware('guest');

Route::post('/password/update', function (Request $request) {
    $request->validate([
        'password' => 'required|min:4|confirmed',
    ], [
        'password.required' => 'Password baru wajib diisi.',
        'password.min' => 'Password minimal 4 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.'
    ]);

    $email = session('reset_email');
    if (!$email) {
        return redirect()->route('password.request')->withErrors(['email' => 'Sesi telah habis, silakan ulangi.']);
    }

    $user = \App\Models\Masyarakat::where('email', $email)->first();
    if ($user) {
        $user->update(['password' => \Illuminate\Support\Facades\Hash::make($request->password)]);
    }

    session()->forget('reset_email');

    return redirect()->route('login')->with('status', 'Password berhasil diubah! Silakan login dengan password baru.');
})->name('password.update');

Route::middleware('auth')->group(function () {
    // Fitur Dashboard (Internal)
    Route::prefix('masyarakat')->name('masyarakat.')->group(function() {
        Route::get('/dashboard', function () { 
            $user = auth()->user();
            if ($user->role === 'kecamatan') {
                // Fetch some stats for Kecamatan
                $totalWarga = \App\Models\Masyarakat::where('alamat', 'like', '%' . $user->nama . '%')->count();
                $totalPengajuan = \App\Models\JadwalJebol::where('lokasi', 'like', '%' . $user->nama . '%')->count();
                $pengajuanAktif = \App\Models\JadwalJebol::where('lokasi', 'like', '%' . $user->nama . '%')->where('tanggal_pelayanan', '>=', \Carbon\Carbon::today())->count();
                
                return view('masyarakat.kecamatan-dashboard', compact('user', 'totalWarga', 'totalPengajuan', 'pengajuanAktif'));
            }
            $services = \Illuminate\Support\Facades\DB::table('services')->where('status', 'AKTIF')->get();
            
            // Real Stats
            $totalPengajuan = \App\Models\PengajuanLayanan::where('nik', $user->nik)->count();
            $statusMenunggu = \App\Models\PengajuanLayanan::where('nik', $user->nik)->where('status', 'pending')->count();
            $statusProses = \App\Models\PengajuanLayanan::where('nik', $user->nik)->where('status', 'diproses')->count();
            $statusSelesai = \App\Models\PengajuanLayanan::where('nik', $user->nik)->where('status', 'selesai')->count();
            
            // Last 5 Permohonan
            $lastPermohonan = \App\Models\PengajuanLayanan::where('nik', $user->nik)
                ->orderBy('tanggal_pengajuan', 'desc')
                ->take(5)
                ->get();

            // Next Schedule hybrid detection
            // 1. Priority 1: Check if user has an upcoming personal permohonan appointment
            $nextSchedule = \App\Models\PengajuanLayanan::where('nik', $user->nik)
                ->where('tanggal_pengajuan', '>=', \Carbon\Carbon::today())
                ->whereIn('status', ['pending', 'diproses'])
                ->orderBy('tanggal_pengajuan', 'asc')
                ->first();

            $isPersonalAppointment = false;
            if ($nextSchedule) {
                $isPersonalAppointment = true;
            } else {
                // 2. Priority 2: General mobile unit schedule
                $nextSchedule = \App\Models\JadwalJebol::where('tanggal_pelayanan', '>=', \Carbon\Carbon::today())
                    ->orderBy('tanggal_pelayanan', 'asc')
                    ->first();

                // 3. Fallback 1: Any upcoming mobile schedule in Tegal City
                if (!$nextSchedule) {
                    $nextSchedule = \App\Models\JadwalJebol::where('tanggal_pelayanan', '>=', \Carbon\Carbon::today())
                        ->orderBy('tanggal_pelayanan', 'asc')
                        ->first();
                }

                // 4. Fallback 2: Latest general mobile schedule
                if (!$nextSchedule) {
                    $nextSchedule = \App\Models\JadwalJebol::orderBy('tanggal_pelayanan', 'desc')->first();
                }
            }

            // Chart Data
            $rekapSelesaiData = [
                \App\Models\PengajuanLayanan::where('nik', $user->nik)->where('status', 'selesai')->where('jenis_layanan', 'IKD')->count(),
                \App\Models\PengajuanLayanan::where('nik', $user->nik)->where('status', 'selesai')->where('jenis_layanan', 'KTP-el')->count(),
                \App\Models\PengajuanLayanan::where('nik', $user->nik)->where('status', 'selesai')->where('jenis_layanan', 'KIA')->count(),
            ];

            return view('masyarakat.dashboard', compact(
                'services', 
                'totalPengajuan', 
                'statusMenunggu', 
                'statusProses', 
                'statusSelesai', 
                'lastPermohonan', 
                'nextSchedule',
                'isPersonalAppointment',
                'rekapSelesaiData'
            )); 
        })->name('dashboard');

        Route::get('/layanan', function () { 
            $services = \Illuminate\Support\Facades\DB::table('services')->where('status', 'AKTIF')->get();
            
            if ($services->isEmpty()) {
                $services = collect([
                    (object)[
                        'name' => 'KTP-el',
                        'status' => 'AKTIF',
                        'icon' => 'badge',
                        'estimation' => '3 Hari Kerja',
                    ],
                    (object)[
                        'name' => 'KIA',
                        'status' => 'AKTIF',
                        'icon' => 'face',
                        'estimation' => '2 Hari Kerja',
                    ],
                    (object)[
                        'name' => 'IKD',
                        'status' => 'AKTIF',
                        'icon' => 'fingerprint',
                        'estimation' => '1 Hari Kerja',
                    ]
                ]);
            }
            
            return view('masyarakat.layanan', compact('services')); 
        })->name('layanan');

        Route::get('/jadwal', [App\Http\Controllers\JadwalController::class, 'publicIndex'])->name('jadwal');
        
        Route::get('/lokasi', function () {
            return view('masyarakat.lokasi');
        })->name('location');
        Route::get('/bantuan', function () { 
            return view('masyarakat.bantuan'); 
        })->name('help');

        Route::get('/kepuasan', [App\Http\Controllers\KepuasanController::class, 'index'])->name('kepuasan');

        Route::post('/kepuasan', [App\Http\Controllers\KepuasanController::class, 'store'])->name('kepuasan.store');

        Route::get('/cek-status', [App\Http\Controllers\PermohonanController::class, 'cekStatus'])->name('cek-status');
        
        Route::get('/pengaturan', function () {
            return view('masyarakat.settings');
        })->name('settings');

        Route::get('/pengaturan/keamanan', function () {
            $sessions = \Illuminate\Support\Facades\DB::table('sessions')
                ->where('user_id', auth()->id())
                ->orderBy('last_activity', 'desc')
                ->get();
                
            $lastLogin = \Illuminate\Support\Facades\DB::table('login_histories')
                ->where('user_id', auth()->id())
                ->where('status', 'Berhasil')
                ->latest('login_at')
                ->first();
                
            return view('masyarakat.settings-security', compact('sessions', 'lastLogin'));
        })->name('settings.security');

        Route::post('/pengaturan/keamanan/logout-other', function () {
            \Illuminate\Support\Facades\DB::table('sessions')
                ->where('user_id', auth()->id())
                ->where('id', '!=', session()->getId())
                ->delete();
            return back()->with('success', 'Berhasil logout dari perangkat lain.');
        })->name('settings.security.logout-other');

        Route::get('/pengaturan/password', function () {
            return view('masyarakat.settings-password');
        })->name('settings.password');

        Route::get('/pengaturan/notifikasi', function () {
            return view('masyarakat.settings-notifications');
        })->name('settings.notifications');


        Route::get('/profil', function () {
            return view('masyarakat.profile');
        })->name('profile');

        Route::post('/pengaturan', [App\Http\Controllers\PermohonanController::class, 'updateSettings'])->name('settings.update');
        Route::post('/pengaturan/password', [App\Http\Controllers\PermohonanController::class, 'updatePassword'])->name('settings.password.update');
        Route::delete('/pengaturan/foto', [App\Http\Controllers\PermohonanController::class, 'deletePhoto'])->name('settings.photo.delete');
    });

    Route::get('/pengajuan', [App\Http\Controllers\PermohonanController::class, 'create'])->name('pengajuan');
    Route::post('/pengajuan', [App\Http\Controllers\PermohonanController::class, 'store'])->name('pengajuan.store');
});


/*
|--------------------------------------------------------------------------
| 3. KELOMPOK CABANG DINAS (PETUGAS)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:admin', 'admin'])->prefix('cabang')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\CabangController::class, 'dashboard'])->name('cabang.dashboard');

    Route::get('/permohonan', function() {
        return redirect()->route('cabang.monitoring');
    })->name('cabang.permohonan');
    
    // Fitur Baru Cabang
    Route::get('/sekolah', [App\Http\Controllers\CabangController::class, 'sekolah'])->name('cabang.sekolah');
    Route::post('/sekolah', [App\Http\Controllers\CabangController::class, 'storeSekolah'])->name('cabang.sekolah.store');
    Route::put('/sekolah/{id}/update-siswa', [App\Http\Controllers\CabangController::class, 'updateSiswa'])->name('cabang.sekolah.update-siswa');
    Route::get('/sekolah/ajukan-jadwal', [App\Http\Controllers\CabangController::class, 'ajukanJadwalSekolah'])->name('cabang.sekolah.ajukan_jadwal');
    Route::post('/sekolah/ajukan-jadwal', [App\Http\Controllers\CabangController::class, 'storeJadwalSekolah'])->name('cabang.sekolah.ajukan_jadwal.store');
    Route::delete('/sekolah/{id}', [App\Http\Controllers\CabangController::class, 'destroySekolah'])->name('cabang.sekolah.destroy');
    Route::get('/jadwal', [App\Http\Controllers\CabangController::class, 'jadwal'])->name('cabang.jadwal');
    Route::get('/jadwal/baru', [App\Http\Controllers\CabangController::class, 'createJadwal'])->name('cabang.jadwal.create');
    Route::post('/jadwal/baru', [App\Http\Controllers\CabangController::class, 'storeJadwal'])->name('cabang.jadwal.store');
    Route::get('/monitoring', [App\Http\Controllers\CabangController::class, 'monitoring'])->name('cabang.monitoring');
    Route::get('/laporan', [\App\Http\Controllers\CabangController::class, 'laporan'])->name('cabang.laporan');
    Route::get('/laporan/cetak', [\App\Http\Controllers\CabangController::class, 'cetakPdf'])->name('cabang.cetakPdf');
    Route::get('/profil', [\App\Http\Controllers\CabangController::class, 'profil'])->name('cabang.profil');
});

// Cabang Dinas (role: cabang_dinas) routes - REDIRECT TO NEW ROUTES
Route::middleware(['auth:admin', 'admin', 'role:cabang_dinas'])->prefix('cabang_dinas')->name('cabang_dinas.')->group(function () {
    Route::any('/{any}', function () {
        return redirect()->route('cabang.dashboard');
    })->where('any', '.*');
});


/*
|--------------------------------------------------------------------------
| 4. KELOMPOK ADMIN PUSAT (SUPER ADMIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:admin', 'admin'])->prefix('admin')->group(function () {

    Route::post('/master-data/kecamatan', [\App\Http\Controllers\MasterDataController::class, 'storeKecamatan'])->name('admin.master-data.kecamatan.store');
    Route::put('/master-data/kecamatan/{id}', [\App\Http\Controllers\MasterDataController::class, 'updateKecamatan'])->name('admin.master-data.kecamatan.update');
    Route::delete('/master-data/kecamatan/{id}', [\App\Http\Controllers\MasterDataController::class, 'destroyKecamatan'])->name('admin.master-data.kecamatan.destroy');
    
    Route::post('/master-data/kelurahan', [\App\Http\Controllers\MasterDataController::class, 'storeKelurahan'])->name('admin.master-data.kelurahan.store');
    Route::put('/master-data/kelurahan/{id}', [\App\Http\Controllers\MasterDataController::class, 'updateKelurahan'])->name('admin.master-data.kelurahan.update');
    Route::delete('/master-data/kelurahan/{id}', [\App\Http\Controllers\MasterDataController::class, 'destroyKelurahan'])->name('admin.master-data.kelurahan.destroy');

    Route::post('/master-data/jenis-layanan', [\App\Http\Controllers\MasterDataController::class, 'storeJenisLayanan'])->name('admin.master-data.jenis-layanan.store');
    Route::put('/master-data/jenis-layanan/{id}', [\App\Http\Controllers\MasterDataController::class, 'updateJenisLayanan'])->name('admin.master-data.jenis-layanan.update');
    Route::delete('/master-data/jenis-layanan/{id}', [\App\Http\Controllers\MasterDataController::class, 'destroyJenisLayanan'])->name('admin.master-data.jenis-layanan.destroy');

    Route::post('/master-data/status-layanan', [\App\Http\Controllers\MasterDataController::class, 'storeStatusLayanan'])->name('admin.master-data.status-layanan.store');
    Route::put('/master-data/status-layanan/{id}', [\App\Http\Controllers\MasterDataController::class, 'updateStatusLayanan'])->name('admin.master-data.status-layanan.update');
    Route::delete('/master-data/status-layanan/{id}', [\App\Http\Controllers\MasterDataController::class, 'destroyStatusLayanan'])->name('admin.master-data.status-layanan.destroy');

    Route::post('/master-data/petugas', [\App\Http\Controllers\MasterDataController::class, 'storePetugas'])->name('admin.master-data.petugas.store');
    Route::put('/master-data/petugas/{id}', [\App\Http\Controllers\MasterDataController::class, 'updatePetugas'])->name('admin.master-data.petugas.update');
    Route::delete('/master-data/petugas/{id}', [\App\Http\Controllers\MasterDataController::class, 'destroyPetugas'])->name('admin.master-data.petugas.destroy');
    // Dashboard Admin
    Route::get('/dashboard', function (\Illuminate\Http\Request $request) {
        $bulan = $request->get('month');
        $tahun = $request->get('year', date('Y'));

        // Query Dasar
        $queryTotal = \App\Models\PengajuanLayanan::query();
        $querySelesai = \App\Models\PengajuanLayanan::where('status', 'selesai');

        // Filter Bulan jika dipilih
        if ($bulan) {
            $queryTotal->whereMonth('tanggal_pengajuan', $bulan)->whereYear('tanggal_pengajuan', $tahun);
            $querySelesai->whereMonth('tanggal_pengajuan', $bulan)->whereYear('tanggal_pengajuan', $tahun);
        } else {
            $queryTotal->whereYear('tanggal_pengajuan', $tahun);
            $querySelesai->whereYear('tanggal_pengajuan', $tahun);
        }

        if (Auth::guard('admin')->user()->role === 'cabang') {
            $kecamatan = Auth::guard('admin')->user()->kecamatan;
            $queryTotal->where('lokasi_pelayanan', 'LIKE', '%' . $kecamatan . '%');
            $querySelesai->where('lokasi_pelayanan', 'LIKE', '%' . $kecamatan . '%');
        }

        // Hitung Statistik
        $totalPengajuan = $queryTotal->count();
        $totalSelesai = $querySelesai->count();
        $totalJadwal = \App\Models\JadwalJebol::count();
        $totalLokasi = \App\Models\LokasiJebol::count();
        $totalPengguna = \App\Models\Masyarakat::count();

        // LOGIKA GRAFIK MINGGUAN (7 Hari Terakhir)
        $chartLabels = [];
        $chartData = [];
        $chartSelesaiData = [];
        $chartTitle = "Statistik Pengajuan (7 Hari Terakhir)";
        
        if ($request->filled('month') && $request->filled('year')) {
            $daysInMonth = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->daysInMonth;
            $startDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->startOfDay();
            $endDate = \Carbon\Carbon::createFromDate($tahun, $bulan, $daysInMonth)->endOfDay();
            $chartTitle = "Statistik Pengajuan (" . \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F Y') . ")";
            
            $stats = \App\Models\PengajuanLayanan::select(
                    \Illuminate\Support\Facades\DB::raw('DATE(tanggal_pengajuan) as tanggal'),
                    \Illuminate\Support\Facades\DB::raw('COUNT(*) as total')
                )
                ->whereBetween('tanggal_pengajuan', [$startDate, $endDate])
                ->groupBy('tanggal')
                ->get()
                ->pluck('total', 'tanggal');
                
            $selesaiStats = \App\Models\PengajuanLayanan::select(
                    \Illuminate\Support\Facades\DB::raw('DATE(tanggal_pengajuan) as tanggal'),
                    \Illuminate\Support\Facades\DB::raw('COUNT(*) as total')
                )
                ->whereBetween('tanggal_pengajuan', [$startDate, $endDate])
                ->where('status', 'selesai')
                ->groupBy('tanggal')
                ->get()
                ->pluck('total', 'tanggal');

            for ($i = 1; $i <= $daysInMonth; $i++) {
                $dateStr = \Carbon\Carbon::createFromDate($tahun, $bulan, $i)->toDateString();
                $chartLabels[] = $i;
                $chartData[] = $stats[$dateStr] ?? 0;
                $chartSelesaiData[] = $selesaiStats[$dateStr] ?? 0;
            }
        } elseif ($request->filled('year') && !$request->filled('month')) {
            $chartTitle = "Statistik Pengajuan (Tahun $tahun)";
            $stats = \App\Models\PengajuanLayanan::select(
                    \Illuminate\Support\Facades\DB::raw('MONTH(tanggal_pengajuan) as bulan'),
                    \Illuminate\Support\Facades\DB::raw('COUNT(*) as total')
                )
                ->whereYear('tanggal_pengajuan', $tahun)
                ->groupBy('bulan')
                ->get()
                ->pluck('total', 'bulan');
                
            $selesaiStats = \App\Models\PengajuanLayanan::select(
                    \Illuminate\Support\Facades\DB::raw('MONTH(tanggal_pengajuan) as bulan'),
                    \Illuminate\Support\Facades\DB::raw('COUNT(*) as total')
                )
                ->whereYear('tanggal_pengajuan', $tahun)
                ->where('status', 'selesai')
                ->groupBy('bulan')
                ->get()
                ->pluck('total', 'bulan');

            for ($i = 1; $i <= 12; $i++) {
                $chartLabels[] = \Carbon\Carbon::create()->month($i)->translatedFormat('M');
                $chartData[] = $stats[$i] ?? 0;
                $chartSelesaiData[] = $selesaiStats[$i] ?? 0;
            }
        } else {
            $startDate = now()->subDays(6)->startOfDay();
            $endDate = now()->endOfDay();
            
            $stats = \App\Models\PengajuanLayanan::select(
                    \Illuminate\Support\Facades\DB::raw('DATE(tanggal_pengajuan) as tanggal'),
                    \Illuminate\Support\Facades\DB::raw('COUNT(*) as total')
                )
                ->whereBetween('tanggal_pengajuan', [$startDate, $endDate])
                ->groupBy('tanggal')
                ->get()
                ->pluck('total', 'tanggal');
                
            $selesaiStats = \App\Models\PengajuanLayanan::select(
                    \Illuminate\Support\Facades\DB::raw('DATE(tanggal_pengajuan) as tanggal'),
                    \Illuminate\Support\Facades\DB::raw('COUNT(*) as total')
                )
                ->whereBetween('tanggal_pengajuan', [$startDate, $endDate])
                ->where('status', 'selesai')
                ->groupBy('tanggal')
                ->get()
                ->pluck('total', 'tanggal');

            for ($i = 6; $i >= 0; $i--) {
                $dateObj = now()->subDays($i);
                $dateStr = $dateObj->toDateString();
                
                $chartLabels[] = $dateObj->translatedFormat('d M');
                $chartData[] = $stats[$dateStr] ?? 0;
                $chartSelesaiData[] = $selesaiStats[$dateStr] ?? 0;
            }
        }

        // Rerata Waktu Layanan (Hari) - Dinonaktifkan sementara karena tidak ada tanggal_selesai di schema baru
        $avgServiceTime = 0;

        // Verifikasi Baru (Recent Activities)
        $recentQuery = \App\Models\PengajuanLayanan::with('masyarakat')
            ->where(function($q) {
                $q->where('status', 'LIKE', '%menunggu%')
                  ->orWhere('status', 'LIKE', '%Menunggu%');
            });
            
        if (Auth::guard('admin')->user()->role === 'cabang') {
            $recentQuery->where('lokasi_pelayanan', 'LIKE', '%' . Auth::guard('admin')->user()->kecamatan . '%');
        }
        
        $recentVerifications = $recentQuery->orderBy('tanggal_pengajuan', 'desc')
            ->take(5)
            ->get();


        // Sebaran Jenis Layanan (Service Type Breakdown)
        $sebaranLayanan = \App\Models\PengajuanLayanan::select('jenis_layanan', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->groupBy('jenis_layanan')
            ->orderBy('total', 'desc')
            ->take(4)
            ->get()
            ->map(function($item) {
                $name = strtolower($item->jenis_layanan);
                if (str_contains($name, 'ktp')) {
                    $item->icon = 'badge';
                    $item->color_class = 'text-blue-600 bg-blue-50 border-blue-100';
                } elseif (str_contains($name, 'kia')) {
                    $item->icon = 'demography';
                    $item->color_class = 'text-amber-600 bg-amber-50 border-amber-100';
                } elseif (str_contains($name, 'ikd')) {
                    $item->icon = 'fingerprint';
                    $item->color_class = 'text-emerald-600 bg-emerald-50 border-emerald-100';
                } else {
                    $item->icon = 'description';
                    $item->color_class = 'text-indigo-600 bg-indigo-50 border-indigo-100';
                }
                return $item;
            });

        $upcomingSchedules = \App\Models\JadwalJebol::where('tanggal_pelayanan', '>=', \Carbon\Carbon::today())
            ->orderBy('tanggal_pelayanan', 'asc')
            ->take(5)
            ->get();

        if ($upcomingSchedules->isEmpty()) {
            $upcomingSchedules = \App\Models\JadwalJebol::orderBy('tanggal_pelayanan', 'desc')
                ->take(5)
                ->get();
        }

        // Map data agar seragam
        $upcomingSchedules = $upcomingSchedules->map(function($schedule) {
            $schedule->kuota = $schedule->kuota ?? 100;
            
            // Use real terisi based on permohonan schedules if possible, else 0. 
            // Currently Jebol has 'jumlah_siswa' or manual counts, let's use 0 if not set.
            $schedule->terisi = $schedule->terisi ?? 0; 
            
            if (!isset($schedule->status) || !$schedule->status) {
                $schedule->status = $schedule->tanggal_pelayanan->isToday() ? 'Berjalan' : 'Aktif';
            } else {
                $schedule->status = ucfirst($schedule->status);
            }
            return $schedule;
        });

        $totalPermohonan = $totalPengajuan;

        return view('admin.dashboard', compact(
            'totalPengajuan',
            'totalPermohonan',
            'totalSelesai', 
            'totalJadwal', 
            'totalLokasi', 
            'totalPengguna',
            'chartData',
            'chartSelesaiData',
            'chartLabels',
            'chartTitle',
            'bulan',
            'tahun',
            'avgServiceTime',
            'recentVerifications',
            'sebaranLayanan',
            'upcomingSchedules'
        ));
    })->name('admin.dashboard');
    
    // Manajemen Lokasi JEBOL (Admin)
    Route::resource('lokasi', \App\Http\Controllers\Admin\LokasiController::class)->names('admin.lokasi')->except(['create', 'show', 'edit']);

    // Manajemen Sekolah (Admin)
    Route::get('/sekolah', function(Request $request) {
        $query = \App\Models\School::query();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama_sekolah', 'LIKE', "%$search%")
                  ->orWhere('npsn', 'LIKE', "%$search%")
                  ->orWhere('kecamatan', 'LIKE', "%$search%");
        }
        $schools = $query->orderBy('kecamatan')->get();
        return view('admin.sekolah', compact('schools'));
    })->name('admin.sekolah');

    Route::post('/sekolah/{id}/update-siswa', function(Request $request, $id) {
        $request->validate(['jumlah_siswa' => 'required|integer|min:0']);
        $school = \App\Models\School::findOrFail($id);
        $school->update(['jumlah_siswa' => $request->jumlah_siswa]);
        return redirect()->route('admin.sekolah')->with('success', 'Jumlah siswa berhasil diperbarui!');
    })->name('admin.sekolah.update-siswa');
    
    Route::post('/sekolah', function(Request $request) {
        $validated = $request->validate([
            'nama_sekolah' => 'required|string',
            'kecamatan' => 'required|string',
            'tingkat' => 'required|string',
            'status' => 'nullable|string',
            'jumlah_siswa' => 'required|integer',
            'fokus_layanan' => 'nullable|string',
        ]);
        $validated['status_jempol'] = 'Belum';
        
        // Auto-assign to correct Cabang based on kecamatan
        $petugas = \App\Models\User::whereIn('role', ['cabang', 'cabang_dinas', 'petugas', 'petugas cabang', 'petugas kecamatan'])->where('kecamatan', $request->kecamatan)->first();
        $validated['cabang_id'] = $petugas ? $petugas->id : 1; 

        \App\Models\School::create($validated);
        return redirect()->route('admin.sekolah')->with('success', 'Sekolah baru berhasil ditambahkan!');
    })->name('admin.sekolah.store');
    
    // Manajemen User
    Route::get('/users', function (Request $request) {
        $userQuery = \App\Models\User::query();
        if ($request->filled('search')) {
            $search = $request->get('search');
            $userQuery->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                  ->orWhere('nik', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%");
            });
        }
        if ($request->role && $request->role !== 'all') {
            $userQuery->where('role', $request->role);
        }
        $users = $userQuery->orderBy('created_at', 'desc')->paginate(10);
        
        $totalCount = \App\Models\User::count();
        $adminCount = \App\Models\User::whereIn('role', ['admin', 'admin pusat'])->count();
        $petugasCount = \App\Models\User::whereIn('role', ['cabang', 'cabang_dinas', 'petugas', 'petugas cabang', 'petugas kecamatan'])->count();
        $citizenCount = \App\Models\Masyarakat::query()->count();

        return view('admin.users', compact(
            'users', 'totalCount', 'adminCount', 'petugasCount', 'citizenCount'
        ));
    })->name('admin.users');

    Route::delete('/users/{id}', function ($id) {
        \App\Models\User::findOrFail($id)->delete();
        return back()->with('success', 'User berhasil dihapus!');
    })->name('admin.users.delete');

    Route::get('/users/create', function () { return view('admin.users-create'); })->name('admin.users.create');
    Route::post('/users/create', function (Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'role' => 'required',
            'nik' => 'required|unique:users',
        ]);

        \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => 'aktif',
            'nik' => $request->nik,
            'kecamatan' => $request->kecamatan,
            'phone' => '08' . rand(100000000, 999999999),
            'location_type' => 'kecamatan',
        ]);

        return redirect()->route('admin.settings')->with('success', 'User ' . $request->name . ' berhasil ditambahkan!');
    })->name('admin.users.store');

    Route::get('/users/{id}/edit', function ($id) {
        $user = \App\Models\User::findOrFail($id);
        return view('admin.users-edit', compact('user'));
    })->name('admin.users.edit');

    Route::put('/users/{id}', function (Request $request, $id) {
        $user = \App\Models\User::findOrFail($id);
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
            'status' => 'required',
            'nik' => 'required|unique:users,nik,' . $id,
        ]);
        
        $user->update($data);
        if ($request->password) {
            $user->password = Hash::make($request->password);
            $user->save();
        }
        
        return redirect()->route('admin.settings')->with('success', 'User berhasil diperbarui!');
    })->name('admin.users.update');

    Route::get('/users/success', function () { return view('admin.users-success'); })->name('admin.users.success');
    
    Route::get('/permohonan', [App\Http\Controllers\PermohonanController::class, 'adminIndex'])->name('admin.permohonan');
    Route::get('/permohonan/{id}', [App\Http\Controllers\PermohonanController::class, 'adminShow'])->name('admin.permohonan.detail');
    Route::post('/permohonan/bulk-schedule', [App\Http\Controllers\PermohonanController::class, 'bulkSchedule'])->name('admin.permohonan.bulk-schedule');
    Route::post('/permohonan/bulk-complete', [App\Http\Controllers\PermohonanController::class, 'bulkComplete'])->name('admin.permohonan.bulk-complete');
    Route::post('/permohonan/{id}/status', [App\Http\Controllers\PermohonanController::class, 'updateStatus'])->name('admin.permohonan.status');
    Route::delete('/permohonan/{id}', [App\Http\Controllers\PermohonanController::class, 'destroy'])->name('admin.permohonan.destroy');
    Route::get('/jadwal', [App\Http\Controllers\JadwalController::class, 'index'])->name('admin.jadwal');
    Route::get('/jadwal/baru', [App\Http\Controllers\JadwalController::class, 'create'])->name('admin.jadwal.create');
    Route::post('/jadwal/baru', [App\Http\Controllers\JadwalController::class, 'store'])->name('admin.jadwal.store');

    Route::get('/laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('admin.laporan');
    Route::get('/laporan/download', [App\Http\Controllers\LaporanController::class, 'download'])->name('admin.laporan.download');
    Route::get('/laporan/target', [App\Http\Controllers\LaporanController::class, 'target'])->name('admin.laporan.target');
    Route::post('/laporan/target', [App\Http\Controllers\LaporanController::class, 'updateTarget'])->name('admin.laporan.target.update');

    Route::get('/kepuasan/dashboard', [App\Http\Controllers\Admin\KepuasanAdminController::class, 'dashboard'])->name('admin.kepuasan.dashboard');
    Route::get('/kepuasan/data', [App\Http\Controllers\Admin\KepuasanAdminController::class, 'index'])->name('admin.kepuasan.index');
    Route::get('/kepuasan/saran', [App\Http\Controllers\Admin\KepuasanAdminController::class, 'saran'])->name('admin.kepuasan.saran');
    Route::get('/kepuasan/laporan', [App\Http\Controllers\Admin\KepuasanAdminController::class, 'laporan'])->name('admin.kepuasan.laporan');
    Route::put('/kepuasan/{id}', [App\Http\Controllers\Admin\KepuasanAdminController::class, 'update'])->name('admin.kepuasan.update');

    // Audit & Backup
    Route::get('/audit', function () {
        $logs = \Illuminate\Support\Facades\DB::table('users')->orderBy('created_at', 'desc')->take(20)->get(); 
        return view('admin.audit', compact('logs'));
    })->name('admin.audit');

    Route::get('/backup', function () {
        return back()->with('success', 'Cadangan database (SI_JEBOL_BACKUP_' . date('Ymd_His') . '.sql) berhasil dibuat dan disimpan di server!');
    })->name('admin.backup');

    Route::post('/settings/agency', function (Request $request) {
        $updateData = [
            'app_name' => $request->app_name,
            'app_tagline' => $request->app_tagline,
        ];
        
        if ($request->hasFile('agency_logo')) {
            $path = $request->file('agency_logo')->store('agency', 'public');
            $updateData['agency_logo'] = $path;
        }

        \Illuminate\Support\Facades\DB::table('app_settings')->where('id', 1)->update($updateData);
        
        return back()->with('success', 'Profil instansi berhasil diperbarui!');
    })->name('admin.settings.agency');

    Route::post('/settings/services', function (Request $request) {
        \Illuminate\Support\Facades\DB::table('services')->insert([
            'name' => $request->name,
            'estimation' => $request->estimation,
            'icon' => $request->icon ?? 'settings_suggest',
            'color' => $request->color ?? 'blue',
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return back()->with('success', 'Layanan baru berhasil ditambahkan!');
    })->name('admin.services.store');

    Route::delete('/settings/services/{id}', function ($id) {
        \Illuminate\Support\Facades\DB::table('services')->where('id', $id)->delete();
        return back()->with('success', 'Layanan berhasil dihapus!');
    })->name('admin.services.delete');

    Route::post('/settings/targets', function (Request $request) {
        $targets = $request->targets;
        if ($targets && is_array($targets)) {
            foreach ($targets as $id => $data) {
                \App\Models\RegionalTarget::where('id', $id)->update([
                    'target_ktp' => $data['ktp'] ?? 0,
                    'target_kia' => $data['kia'] ?? 0,
                    'target_ikd' => $data['ikd'] ?? 0,
                ]);
            }
        }
        return back()->with('success', 'Target capaian wilayah berhasil diperbarui!');
    })->name('admin.settings.targets');

    // 4. Data Wilayah
    Route::post('/settings/regions', function (Request $request) {
        $request->validate(['kecamatan' => 'required', 'kelurahan' => 'required']);
        \Illuminate\Support\Facades\DB::table('regions')->insert([
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return back()->with('success', 'Data kelurahan berhasil ditambahkan!');
    })->name('admin.settings.regions.store');

    Route::delete('/settings/regions/{id}', function ($id) {
        \Illuminate\Support\Facades\DB::table('regions')->where('id', $id)->delete();
        return back()->with('success', 'Data wilayah berhasil dihapus!');
    })->name('admin.settings.regions.delete');

    // 8. Jadwal Operasional
    Route::post('/settings/operational', function (Request $request) {
        $schedule = [
            'senin_kamis' => $request->senin_kamis,
            'jumat' => $request->jumat,
            'sabtu' => $request->sabtu,
            'minggu' => $request->minggu
        ];
        \Illuminate\Support\Facades\DB::table('app_settings')->where('id', 1)->update([
            'operational_hours' => json_encode($schedule)
        ]);
        return back()->with('success', 'Jadwal operasional berhasil diperbarui!');
    })->name('admin.settings.operational');

    // 9. Notifikasi Sistem
    Route::post('/settings/notifications', function (Request $request) {
        $notif = [
            'email_pengajuan_baru' => $request->has('email_pengajuan_baru'),
            'email_perubahan_jadwal' => $request->has('email_perubahan_jadwal'),
            'sms_notifikasi' => $request->has('sms_notifikasi')
        ];
        \Illuminate\Support\Facades\DB::table('app_settings')->where('id', 1)->update([
            'notification_settings' => json_encode($notif)
        ]);
        return back()->with('success', 'Pengaturan notifikasi berhasil diperbarui!');
    })->name('admin.settings.notifications');

    // 10. Template Surat
    Route::post('/settings/templates', function (Request $request) {
        $settings = \Illuminate\Support\Facades\DB::table('app_settings')->first();
        $templates = json_decode($settings->document_templates, true) ?? ['kop_surat' => null, 'stempel' => null];
        
        if ($request->hasFile('kop_surat')) {
            $path = $request->file('kop_surat')->store('templates', 'public');
            $templates['kop_surat'] = $path;
        }
        if ($request->hasFile('stempel')) {
            $path = $request->file('stempel')->store('templates', 'public');
            $templates['stempel'] = $path;
        }
        \Illuminate\Support\Facades\DB::table('app_settings')->where('id', 1)->update([
            'document_templates' => json_encode($templates)
        ]);
        return back()->with('success', 'Template dokumen berhasil diunggah!');
    })->name('admin.settings.templates');

    // 11. Gateway Notifikasi
    Route::post('/settings/gateway', function (Request $request) {
        $settings = \Illuminate\Support\Facades\DB::table('app_settings')->first();
        $notif = json_decode($settings->notification_settings ?? '{}', true);
        
        $notif['wa_active'] = $request->has('wa_active');
        $notif['fonnte_token'] = $request->fonnte_token;
        $notif['email_sender_name'] = $request->email_sender_name;
        
        \Illuminate\Support\Facades\DB::table('app_settings')->where('id', 1)->update([
            'notification_settings' => json_encode($notif)
        ]);
        
        return back()->with('success', 'Pengaturan Gateway Notifikasi berhasil disimpan!');
    })->name('admin.settings.gateway');

    // Test Gateway Notifikasi
    Route::post('/settings/gateway/test', function (Illuminate\Http\Request $request) {
        $request->validate(['phone' => 'required']);
        $message = "Halo! Ini adalah pesan uji coba dari SI JEBOL untuk memastikan Gateway WhatsApp (Fonnte) Anda berfungsi dengan baik.\n\n" . now()->format('d M Y H:i:s');
        $success = \App\Services\WhatsAppService::send($request->phone, $message);
        
        if ($success) {
            return back()->with('success', 'Pesan uji coba telah dikirim ke nomor ' . $request->phone);
        } else {
            return back()->withErrors(['phone' => 'Gagal mengirim WA! Pastikan Token Anda benar dan perangkat WhatsApp Anda dalam status terhubung/online di Fonnte.']);
        }
    })->name('admin.settings.test_wa');

    // Profil Akun Admin (Halaman Tersendiri)
    Route::get('/profil', function () {
        return view('admin.profil');
    })->name('admin.profil');

    // Halaman Edit Profil Admin
    Route::get('/profil/edit', function () {
        return view('admin.profil-edit');
    })->name('admin.profil.edit');

    // Halaman Ubah Password Admin
    Route::get('/profil/password', function () {
        return view('admin.profil-password');
    })->name('admin.profil.password');



    // Halaman Notifikasi (Settings)
    Route::get('/settings/notifications', function () {
        return view('admin.settings-notifications');
    })->name('admin.settings.notifications_page');

    // Halaman Keamanan Akun
    Route::get('/settings/security', function () {
        $histories = \Illuminate\Support\Facades\DB::table('login_histories')
            ->where('user_id', auth()->id())
            ->orderBy('login_at', 'desc')
            ->take(1)
            ->get();
        return view('admin.settings-security', compact('histories'));
    })->name('admin.settings.security');

    // Halaman Pengaturan Pengguna
    Route::get('/settings/users', function () {
        $users = \App\Models\User::whereIn('role', ['admin', 'admin pusat', 'cabang', 'cabang_dinas', 'petugas', 'petugas cabang', 'petugas kecamatan'])
            ->orderByRaw("CASE WHEN LOWER(role) LIKE '%admin%' THEN 1 ELSE 2 END")
            ->orderBy('id', 'asc')
            ->get();
        return view('admin.settings-users', compact('users'));
    })->name('admin.settings.users');



    // Redirect Halaman Tentang Aplikasi dan Notifikasi ke Pengguna
    Route::get('/settings/about', function () {
        return redirect()->route('admin.settings.users');
    })->name('admin.settings.about');

    Route::post('/settings/about', function (Illuminate\Http\Request $request) {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'agency_name' => 'required|string|max:255',
            'app_tagline' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'contact_address' => 'nullable|string',
            'agency_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $data = $request->only(['app_name', 'agency_name', 'app_tagline', 'contact_email', 'contact_address']);

        if ($request->hasFile('agency_logo')) {
            $file = $request->file('agency_logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/settings'), $filename);
            $data['agency_logo'] = 'uploads/settings/' . $filename;
        }

        \Illuminate\Support\Facades\DB::table('app_settings')->where('id', 1)->update($data);

        return back()->with('success', 'Informasi Aplikasi berhasil diperbarui!');
    })->name('admin.settings.about.update');

    // Update Profil Admin (Nama, Email, Phone dll)
    Route::post('/profil/update', function (Illuminate\Http\Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'username' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'jabatan' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        $user = Auth::guard('admin')->user() ?? Auth::guard('masyarakat')->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->username = $request->username;
        $user->jabatan = $request->jabatan;
        $user->alamat = $request->alamat;

        if ($request->hasFile('foto_profil')) {
            $path = $request->file('foto_profil')->store('avatars', 'public');
            $user->foto_profil = $path;
        }

        $user->save();
        
        return back()->with('success', 'Profil akun berhasil diperbarui!');
    })->name('admin.profil.update');

    // Update Password Admin
    Route::post('/profil/security', function (Illuminate\Http\Request $request) {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',


        ]);
        $user = Auth::guard('admin')->user() ?? Auth::guard('masyarakat')->user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak cocok']);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return back()->with('success', 'Password berhasil diubah!');
    })->name('admin.profil.security');




    // 13. Target Capaian Wilayah
    Route::post('/settings/targets', [\App\Http\Controllers\LaporanController::class, 'updateTarget'])->name('admin.settings.targets');

});

Route::get('/seed-regional-targets', function() {
    if (!\Illuminate\Support\Facades\Schema::hasTable('regional_targets')) {
        \Illuminate\Support\Facades\Schema::create('regional_targets', function (\Illuminate\Database\Schema\Blueprint $table) {
            $table->id();
            $table->string('kecamatan');
            $table->string('kelurahan')->nullable();
            $table->integer('target_ktp')->default(0);
            $table->integer('target_kia')->default(0);
            $table->integer('target_ikd')->default(0);
            $table->timestamps();
        });

        $kecamatanMap = [
            ['nama' => 'KOTA TEGAL', 'desa' => []],
            ['nama' => 'TEGAL BARAT', 'desa' => ['PESURUNGAN KIDUL', 'DEBONG LOR', 'KEMANDUNGAN', 'PEKAUMAN', 'KRATON', 'TEGALSARI', 'MUARAREJA']],
            ['nama' => 'TEGAL TIMUR', 'desa' => ['SLEROK', 'PANGGUNG', 'MANGKUKUSUMAN', 'KEJAMBON', 'MINTARAGEN']],
            ['nama' => 'TEGAL SELATAN', 'desa' => ['RANDUGUNTING', 'TUNON', 'BANDUNG', 'DEBONG KIDUL', 'DEBONG KULON', 'DEBONG TENGAH', 'KETUREN']],
            ['nama' => 'MARGADANA', 'desa' => ['MARGADANA', 'CABAWAN', 'KALIGANGSA', 'KRANGDON', 'PESURUNGAN LOR', 'SUMURPANGGANG']],
        ];

        foreach ($kecamatanMap as $kec) {
            \Illuminate\Support\Facades\DB::table('regional_targets')->insert([
                'kecamatan' => $kec['nama'],
                'kelurahan' => null,
                'target_ktp' => 1000,
                'target_kia' => 500,
                'target_ikd' => 1500,
            ]);
            foreach ($kec['desa'] as $desa) {
                \Illuminate\Support\Facades\DB::table('regional_targets')->insert([
                    'kecamatan' => $kec['nama'],
                    'kelurahan' => $desa,
                    'target_ktp' => 200,
                    'target_kia' => 100,
                    'target_ikd' => 300,
                ]);
            }
        }
        return "Tabel regional_targets berhasil dibuat dan diisi!";
    }
    return "Tabel regional_targets sudah ada.";
});

// ---------------------------------------------------------------
// Separate login pages for each role
// ---------------------------------------------------------------

// Admin login
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::post('/admin/login', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'nik' => 'required',
        'password' => 'required',
    ]);
    if (\Illuminate\Support\Facades\Auth::guard('web')->attempt(['nik' => $request->nik, 'password' => $request->password])) {
        $request->session()->regenerate();
        $user = \Illuminate\Support\Facades\Auth::guard('web')->user();
        
        \Illuminate\Support\Facades\DB::table('login_histories')->insert([
            'user_id' => $user->id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'login_at' => now(),
            'status' => 'Berhasil'
        ]);

        // ensure admin role
        if (in_array(trim(strtolower($user->role)), ['admin', 'admin pusat'])) {
            return redirect('/admin/dashboard');
        } else {
            \Illuminate\Support\Facades\Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
    }
    return back()->withErrors(['nik' => 'Invalid credentials for admin.']);
})->name('admin.login.post');

// Cabang Dinas login
Route::get('/cabang/login', function () {
    return view('cabang.login');
})->name('cabang.login');

Route::post('/cabang/login', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'nik' => 'required',
        'password' => 'required',
    ]);
    if (\Illuminate\Support\Facades\Auth::guard('web')->attempt(['nik' => $request->nik, 'password' => $request->password])) {
        $request->session()->regenerate();
        $user = \Illuminate\Support\Facades\Auth::guard('web')->user();
        if (in_array(trim(strtolower($user->role)), ['cabang', 'cabang_dinas', 'petugas', 'petugas cabang', 'petugas kecamatan'])) {
            return redirect('/cabang/dashboard');
        } else {
            \Illuminate\Support\Facades\Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
    }
    return back()->withErrors(['nik' => 'Invalid credentials for cabang dinas.']);
})->name('cabang.login.post');


Route::middleware(['auth:web'])->group(function () {
    Route::get('/logout-panel', function (Illuminate\Http\Request $request) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('panel.logout');
});

Route::post('/admin/verify-password', function (\Illuminate\Http\Request $request) {
    if ($request->password === '123456') {
        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false], 401);
})->name('admin.verify-password');



Route::get('/run-settings-migration', function() {
    try {
        if (!\Illuminate\Support\Facades\Schema::hasColumn('users', 'username')) {
            \Illuminate\Support\Facades\Schema::table('users', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->string('username')->nullable()->unique()->after('name');
                $table->string('jabatan')->nullable()->after('phone');
                $table->text('alamat')->nullable()->after('jabatan');
                $table->string('foto_profil')->nullable()->after('alamat');
                $table->json('preferences')->nullable()->after('foto_profil');
            });
        }
        if (!\Illuminate\Support\Facades\Schema::hasTable('login_histories')) {
            \Illuminate\Support\Facades\Schema::create('login_histories', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('ip_address')->nullable();
                $table->text('user_agent')->nullable();
                $table->timestamp('login_at')->useCurrent();
                $table->string('status')->default('Berhasil');
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
        return "Migration settings berhasil!";
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});
