@php
if (!\Illuminate\Support\Facades\Cache::has('force_seed_targets_done_5')) {
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
    // Seed KOTA TEGAL row
    \Illuminate\Support\Facades\DB::table('regional_targets')->insert(['kecamatan' => 'KOTA TEGAL', 'kelurahan' => null, 'target_ktp' => 0, 'target_kia' => 0, 'target_ikd' => 0, 'created_at' => now(), 'updated_at' => now()]);
    $kecamatans = ['TEGAL BARAT' => ['PESURUNGAN KIDUL', 'DEBONG LOR', 'KEMANDUNGAN', 'PEKAUMAN', 'KRATON', 'TEGALSARI', 'MUARAREJA'], 'TEGAL TIMUR' => ['SLEROK', 'PANGGUNG', 'MANGKUKUSUMAN', 'KEJAMBON', 'MINTARAGEN'], 'TEGAL SELATAN' => ['RANDUGUNTING', 'TUNON', 'BANDUNG', 'DEBONG KIDUL', 'DEBONG KULON', 'DEBONG TENGAH', 'KETUREN'], 'MARGADANA' => ['MARGADANA', 'CABAWAN', 'KALIGANGSA', 'KRANGDON', 'PESURUNGAN LOR', 'SUMURPANGGANG']];
    foreach ($kecamatans as $kec => $kelurahans) {
        \Illuminate\Support\Facades\DB::table('regional_targets')->insert(['kecamatan' => $kec, 'kelurahan' => null, 'target_ktp' => 0, 'target_kia' => 0, 'target_ikd' => 0, 'created_at' => now(), 'updated_at' => now()]);
        foreach ($kelurahans as $kel) {
            \Illuminate\Support\Facades\DB::table('regional_targets')->insert(['kecamatan' => $kec, 'kelurahan' => $kel, 'target_ktp' => 0, 'target_kia' => 0, 'target_ikd' => 0, 'created_at' => now(), 'updated_at' => now()]);
        }
    }
    \Illuminate\Support\Facades\Cache::put('force_seed_targets_done_5', true, 60);
}
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Kelola Target Layanan - SI JEBOL</title>
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#003178",
                        "background": "#f8fafc",
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        body { 
             
            background-color: #f8fafc !important; 
        }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="jbl-386 jbl-342 jbl-461">
    <div class="no-print">
        @include('partials.admin-sidebar-premium')
    </div>

    <main class="jbl-967 jbl-461 jbl-1197">
        <div class="jbl-746 jbl-1539 jbl-1342">
            
            <div class="jbl-242 jbl-224 jbl-1133 jbl-1190 jbl-1285 jbl-59 jbl-948 jbl-1361 jbl-1109 jbl-35" style="background-color: #003178; background-image: linear-gradient(rgba(0,49,120,0.9), rgba(0,49,120,0.9)), url('/images/batik-tegal-premium.jpg'); background-size: cover; border-bottom: 4px solid #f59e0b; box-shadow: 0 20px 40px rgba(0,49,120,0.15);">
                <div class="jbl-91 jbl-1062 jbl-907" style="background-image: url('/images/batik-tegal-premium.jpg'); background-size: 400px; opacity: 0.12; mix-blend-mode: luminosity;"></div>
                <div class="jbl-91 jbl-3 jbl-321 jbl-1365 jbl-1468 jbl-201 jbl-1106 jbl-835 jbl-44 jbl-6 jbl-1069"></div>
                <div class="jbl-91 jbl-588 jbl-833 jbl-116 jbl-981 jbl-794 jbl-835 jbl-734 jbl-6 jbl-780"></div>
                
                <div class="jbl-1109 jbl-1117 jbl-1293 jbl-1541 jbl-744 jbl-133 jbl-1409 jbl-1051">
                    <div class="jbl-1293 jbl-1426 jbl-1485">
                        <div class="jbl-592 jbl-388 jbl-366 jbl-531 jbl-1149 jbl-1400 jbl-1406 jbl-1293 jbl-1426 jbl-141 jbl-333 jbl-811 jbl-1540">
                            <span class="material-symbols-outlined jbl-264 jbl-1509">settings_suggest</span>
                        </div>
                        <div>
                            <div class="jbl-1293 jbl-1426 jbl-985 jbl-1195">
                                <h1 class="jbl-47 jbl-586 jbl-1511 jbl-1361">Kelola Target Layanan</h1>
                            </div>
                            <p class="jbl-13 jbl-166 jbl-772">Manajemen target capaian IKD, KTP-el, dan KIA per wilayah</p>
                        </div>
                    </div>
                    <div class="jbl-1293 jbl-1426 jbl-985">
                        <a href="{{ route('admin.laporan') }}" class="jbl-433 jbl-345 jbl-1112 jbl-1296 jbl-1361 jbl-1320 jbl-166 jbl-959 jbl-1288 jbl-333 jbl-777 jbl-1293 jbl-1426 jbl-745">
                            <span class="material-symbols-outlined jbl-166">arrow_back</span>
                            Kembali ke Laporan
                        </a>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="jbl-313 jbl-416 jbl-156 jbl-1320 jbl-454 jbl-1293 jbl-1046 jbl-985 jbl-333 jbl-439">
                    <span class="material-symbols-outlined jbl-901 jbl-1213">check_circle</span>
                    <div>
                        <h4 class="jbl-959 jbl-166">Berhasil!</h4>
                        <p class="jbl-843 jbl-1237">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.laporan.target.update') }}" method="POST">
                @csrf
                <div class="jbl-434 jbl-1320 jbl-333 jbl-121 jbl-160 jbl-35 jbl-454">
                    <div class="jbl-1545 jbl-1049 jbl-121 jbl-1445">
                        <h3 class="jbl-105 jbl-959 jbl-386 jbl-1293 jbl-1426 jbl-745">
                            <span class="material-symbols-outlined jbl-1509">edit_note</span>
                            Pilih Wilayah & Edit Target
                        </h3>
                        <p class="jbl-147 jbl-843 jbl-1237">Isikan target per kecamatan. Data ini akan digunakan untuk menghitung jumlah "Belum/Target" di menu laporan.</p>
                    </div>
                    
                    <div class="jbl-375">
                        <table class="jbl-1539 jbl-1103 jbl-166 jbl-1306 jbl-325">
                            <thead>
                                <tr>
                                    <th class="jbl-181 jbl-1569 jbl-1397 jbl-1574 jbl-995 jbl-333 jbl-121">Kode</th>
                                    <th class="jbl-181 jbl-1569 jbl-1397 jbl-1574 jbl-995 jbl-333 jbl-121">Wilayah</th>
                                    <th class="jbl-181 jbl-1569 jbl-1397 jbl-1574 jbl-995 jbl-333 jbl-121">Target IKD</th>
                                    <th class="jbl-181 jbl-1569 jbl-1397 jbl-1574 jbl-995 jbl-333 jbl-121">Target KTP-el</th>
                                    <th class="jbl-181 jbl-1569 jbl-1397 jbl-1574 jbl-995 jbl-333 jbl-121">Target KIA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="jbl-1006 jbl-1361 jbl-959">
                                    <td class="jbl-181 jbl-1569 jbl-333 jbl-1519 jbl-622 jbl-1100">33.76</td>
                                    <td class="jbl-181 jbl-1569 jbl-333 jbl-1519 jbl-1361 jbl-586">KOTA TEGAL</td>
                                    @if(isset($kotaTarget))
                                    <td class="jbl-181 jbl-345 jbl-333 jbl-1519">
                                        <input type="number" name="targets[{{ $kotaTarget->id }}][ikd]" value="{{ $kotaTarget->target_ikd }}" class="jbl-211 jbl-1112 jbl-333 jbl-52 jbl-538 jbl-120 jbl-525 jbl-166 jbl-456 jbl-597 jbl-1463 jbl-85 jbl-1288 jbl-586 jbl-1361 jbl-961 jbl-1540">
                                    </td>
                                    <td class="jbl-181 jbl-345 jbl-333 jbl-1519">
                                        <input type="number" name="targets[{{ $kotaTarget->id }}][ktp]" value="{{ $kotaTarget->target_ktp }}" class="jbl-211 jbl-1112 jbl-333 jbl-52 jbl-538 jbl-120 jbl-525 jbl-166 jbl-456 jbl-597 jbl-1463 jbl-85 jbl-1288 jbl-586 jbl-1361 jbl-961 jbl-1540">
                                    </td>
                                    <td class="jbl-181 jbl-345 jbl-333 jbl-1519">
                                        <input type="number" name="targets[{{ $kotaTarget->id }}][kia]" value="{{ $kotaTarget->target_kia }}" class="jbl-211 jbl-1112 jbl-333 jbl-52 jbl-538 jbl-120 jbl-525 jbl-166 jbl-456 jbl-597 jbl-1463 jbl-85 jbl-1288 jbl-586 jbl-1361 jbl-961 jbl-1540">
                                    </td>
                                    @else
                                    <td colspan="3" class="jbl-181 jbl-1569 jbl-333 jbl-1519 jbl-1084 jbl-424 jbl-843">-</td>
                                    @endif
                                </tr>
                                @foreach($kecamatanTargets as $kecamatanName => $targetKec)
                                @php 
                                    $kodeKec = $kecamatanMap[$kecamatanName] ?? '00'; 
                                    $kelurahans = $kelurahanTargets[$kecamatanName] ?? [];
                                @endphp
                                <tr class="jbl-1093 jbl-959 jbl-1372 jbl-632">
                                    <td class="jbl-181 jbl-1569 jbl-333 jbl-121 jbl-1174">33.76.{{ $kodeKec }}</td>
                                    <td class="jbl-181 jbl-1569 jbl-333 jbl-121 jbl-421 jbl-959">{{ $kecamatanName }} (TOTAL KECAMATAN)</td>
                                    <td class="jbl-181 jbl-345 jbl-333 jbl-121">
                                        <input type="number" name="targets[{{ $targetKec->id }}][ikd]" value="{{ $targetKec->target_ikd }}" class="jbl-211 jbl-434 jbl-333 jbl-448 jbl-538 jbl-120 jbl-525 jbl-166 jbl-456 jbl-62 jbl-990 jbl-85 jbl-1288 jbl-959 jbl-421 jbl-160">
                                    </td>
                                    <td class="jbl-181 jbl-345 jbl-333 jbl-121">
                                        <input type="number" name="targets[{{ $targetKec->id }}][ktp]" value="{{ $targetKec->target_ktp }}" class="jbl-211 jbl-434 jbl-333 jbl-448 jbl-538 jbl-120 jbl-525 jbl-166 jbl-456 jbl-62 jbl-990 jbl-85 jbl-1288 jbl-959 jbl-421 jbl-160">
                                    </td>
                                    <td class="jbl-181 jbl-345 jbl-333 jbl-121">
                                        <input type="number" name="targets[{{ $targetKec->id }}][kia]" value="{{ $targetKec->target_kia }}" class="jbl-211 jbl-434 jbl-333 jbl-448 jbl-538 jbl-120 jbl-525 jbl-166 jbl-456 jbl-62 jbl-990 jbl-85 jbl-1288 jbl-959 jbl-421 jbl-160">
                                    </td>
                                </tr>
                                    @foreach($kelurahans as $index => $targetKel)
                                    <tr class="jbl-582 jbl-632">
                                        <td class="jbl-181 jbl-1569 jbl-333 jbl-121 jbl-147">33.76.{{ $kodeKec }}.{{ 1001 + $index }}</td>
                                        <td class="jbl-181 jbl-1569 jbl-333 jbl-121 jbl-386 jbl-854">{{ $targetKel->kelurahan }}</td>
                                        <td class="jbl-181 jbl-345 jbl-333 jbl-121">
                                            <input type="number" name="targets[{{ $targetKel->id }}][ikd]" value="{{ $targetKel->target_ikd }}" class="jbl-211 jbl-434 jbl-333 jbl-831 jbl-538 jbl-120 jbl-525 jbl-166 jbl-456 jbl-62 jbl-990 jbl-85 jbl-1288">
                                        </td>
                                        <td class="jbl-181 jbl-345 jbl-333 jbl-121">
                                            <input type="number" name="targets[{{ $targetKel->id }}][ktp]" value="{{ $targetKel->target_ktp }}" class="jbl-211 jbl-434 jbl-333 jbl-831 jbl-538 jbl-120 jbl-525 jbl-166 jbl-456 jbl-62 jbl-990 jbl-85 jbl-1288">
                                        </td>
                                        <td class="jbl-181 jbl-345 jbl-333 jbl-121">
                                            <input type="number" name="targets[{{ $targetKel->id }}][kia]" value="{{ $targetKel->target_kia }}" class="jbl-211 jbl-434 jbl-333 jbl-831 jbl-538 jbl-120 jbl-525 jbl-166 jbl-456 jbl-62 jbl-990 jbl-85 jbl-1288">
                                        </td>
                                    </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="jbl-1545 jbl-1234 jbl-121 jbl-1445 jbl-1293 jbl-1171">
                        <button type="submit" class="jbl-725 jbl-12 jbl-44 jbl-258 jbl-1361 jbl-959 jbl-1320 jbl-166 jbl-1288 jbl-160 jbl-1293 jbl-1426 jbl-745">
                            <span class="material-symbols-outlined jbl-1203">save</span>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>

            <div class="jbl-176 jbl-333 jbl-935 jbl-156 jbl-1320 jbl-1293 jbl-1046 jbl-985 jbl-858">
                <span class="material-symbols-outlined jbl-1381 jbl-1213">info</span>
                <div>
                    <h4 class="jbl-959 jbl-166 jbl-421">Informasi</h4>
                    <p class="jbl-843 jbl-202 jbl-1237 jbl-787">
                        Data "Selesai" pada laporan diambil otomatis dari layanan yang sudah selesai diproses (status Selesai). Data "Belum" akan dihitung otomatis dengan mengurangi jumlah Selesai dari Target Layanan yang Anda tentukan di halaman ini. Target dibagi secara merata untuk setiap kelurahan di dalam kecamatan tersebut.
                    </p>
                </div>
            </div>

        </div>
    </main>
</body>
</html>

