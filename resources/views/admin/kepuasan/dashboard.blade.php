<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Manajemen Penilaian Layanan - SI JEBOL Admin</title>
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <!-- AlpineJS for interaction -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
        
        .star-filled { color: #fbbf24; }
        .star-empty { color: #e2e8f0; }
    </style>
</head>
<body class="jbl-386 jbl-342 jbl-461">
    
    @include('partials.admin-sidebar-premium')

    <main class="jbl-967 jbl-461 jbl-1151" x-data="{ currentId: null, currentMasyarakat: '', currentSaran: '', currentKeseluruhan: 0, currentLayanan: '', currentDate: '' }">
        <div class="jbl-1539 jbl-1342">
            
            <!-- Premium Header -->
            <div class="jbl-1539 jbl-746 jbl-197 jbl-1506 jbl-1361 jbl-1109 jbl-35 jbl-1293 jbl-1541 jbl-141 jbl-454" style="background-color: #003178; background-image: linear-gradient(rgba(0,49,120,0.9), rgba(0,49,120,0.9)), url('{{ asset('images/batik-tegal-premium.jpg') }}'); background-size: cover; border-bottom: 4px solid #f59e0b; box-shadow: 0 20px 40px rgba(0,49,120,0.15);">
                <div class="jbl-91 jbl-1062 jbl-907" style="background-image: url('{{ asset('images/batik-tegal-premium.jpg') }}'); background-size: 400px; opacity: 0.12; mix-blend-mode: luminosity;"></div>
                
                <!-- Decorative Elements -->
                <div class="jbl-91 jbl-3 jbl-321 jbl-1365 jbl-1468 jbl-201 jbl-1106 jbl-835 jbl-44 jbl-6 jbl-1069"></div>
                <div class="jbl-91 jbl-588 jbl-833 jbl-116 jbl-981 jbl-794 jbl-835 jbl-1518 jbl-694 jbl-780"></div>
                
                <div class="jbl-1109 jbl-1117 jbl-1293 jbl-1541 jbl-744 jbl-1409 jbl-1046 jbl-133 jbl-1051">
                    <div class="jbl-1293 jbl-1426 jbl-701 jbl-661">
                        <div class="jbl-1184 jbl-1021 jbl-675 jbl-1187 jbl-366 jbl-362 jbl-153 jbl-1562 jbl-1406 jbl-1293 jbl-1426 jbl-141 jbl-333 jbl-52 jbl-1001 jbl-709 jbl-1109 jbl-35 jbl-304">
                            <div class="jbl-91 jbl-1062 jbl-1391 jbl-687 jbl-1053 jbl-729 jbl-476"></div>
                            <span class="material-symbols-outlined jbl-47 jbl-862 jbl-557 jbl-1182 jbl-75 jbl-717 jbl-119 jbl-476">star</span>
                        </div>
                        <div>
                            <h1 class="jbl-742 jbl-1076 jbl-1332 jbl-586 jbl-1466 jbl-340 jbl-1536 jbl-774 jbl-1514 jbl-589 jbl-1511 jbl-1429 jbl-1131" style="text-shadow: 0 4px 12px rgba(0,0,0,0.1);">Kelola Hasil Kepuasan Warga</h1>
                            <div class="jbl-1293 jbl-358 jbl-1426 jbl-745">
                                <span class="jbl-622 jbl-843 jbl-853 jbl-772">Kelola dan pantau hasil penilaian kepuasan warga terhadap layanan.</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="jbl-843 jbl-959 jbl-1084 jbl-1462 jbl-1471 jbl-1112 jbl-181 jbl-345 jbl-1320 jbl-1400 jbl-333 jbl-777 jbl-1540">
                        Dashboard > Kepuasan Warga
                    </div>
                </div>
            </div>
 
            @if(session('success'))
            <div class="jbl-156 jbl-313 jbl-416 jbl-1320 jbl-333 jbl-439 jbl-454 jbl-1293 jbl-1426 jbl-985 jbl-160">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
            @endif

            <!-- Stats Widgets -->
            <div class="jbl-174 jbl-1019 jbl-1521 jbl-1051">
                <!-- Total Penilaian -->
                <div class="jbl-434 jbl-1406 jbl-746 jbl-333 jbl-1319 jbl-389 jbl-1293 jbl-1426 jbl-1485">
                    <div class="jbl-688 jbl-408 jbl-835 jbl-176 jbl-1381 jbl-1293 jbl-1426 jbl-141 jbl-795">
                        <span class="material-symbols-outlined jbl-47" style="font-variation-settings: 'FILL' 1;">assignment</span>
                    </div>
                    <div>
                        <p class="jbl-1574 jbl-252 jbl-772 jbl-1195">Total Penilaian</p>
                        <h3 class="jbl-47 jbl-959 jbl-184 jbl-1195">{{ $totalPenilaian }}</h3>
                        <p class="jbl-13 jbl-843">Penilaian dari masyarakat</p>
                    </div>
                </div>

                <!-- Rata-rata Rating -->
                <div class="jbl-434 jbl-1406 jbl-746 jbl-333 jbl-1319 jbl-389 jbl-1293 jbl-1426 jbl-1485">
                    <div class="jbl-688 jbl-408 jbl-835 jbl-313 jbl-901 jbl-1293 jbl-1426 jbl-141 jbl-795">
                        <span class="material-symbols-outlined jbl-47" style="font-variation-settings: 'FILL' 1;">star</span>
                    </div>
                    <div>
                        <p class="jbl-1574 jbl-252 jbl-772 jbl-1195">Rata-rata Rating</p>
                        <h3 class="jbl-47 jbl-959 jbl-901 jbl-1195">{{ number_format($avgKeseluruhan, 2, ',', '.') }} / 5</h3>
                        <p class="jbl-13 jbl-843">Dari seluruh penilaian</p>
                    </div>
                </div>

                <!-- Layanan Terbanyak Dinilai -->
                <div class="jbl-434 jbl-1406 jbl-746 jbl-333 jbl-1319 jbl-389 jbl-1293 jbl-1426 jbl-1485">
                    <div class="jbl-688 jbl-408 jbl-835 jbl-1371 jbl-644 jbl-1293 jbl-1426 jbl-141 jbl-795">
                        <span class="material-symbols-outlined jbl-47" style="font-variation-settings: 'FILL' 1;">description</span>
                    </div>
                    <div>
                        <p class="jbl-1574 jbl-252 jbl-772 jbl-1195">Layanan Terbanyak Dinilai</p>
                        <h3 class="jbl-105 jbl-959 jbl-337 jbl-1195 jbl-1542 jbl-1218" title="{{ $layananTerbanyakNama }}">{{ $layananTerbanyakNama }}</h3>
                        <p class="jbl-13 jbl-843">Layanan dengan data terbanyak</p>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="jbl-434 jbl-1406 jbl-333 jbl-1319 jbl-389 jbl-156 jbl-1312 jbl-652">
                <form action="{{ route('admin.kepuasan.dashboard') }}" method="GET" class="jbl-1293 jbl-358 jbl-1460 jbl-735 jbl-701">
                    
                    <div class="jbl-1539 jbl-748">
                        <label class="jbl-225 jbl-843 jbl-1397 jbl-431 jbl-1429">Cari nama pemohon</label>
                        <div class="jbl-1109">
                            <span class="material-symbols-outlined jbl-91 jbl-94 jbl-256 jbl-1167 jbl-13 jbl-900">search</span>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Masukkan nama pemohon..." 
                                class="jbl-1539 jbl-1071 jbl-629 jbl-12 jbl-434 jbl-333 jbl-121 jbl-1320 jbl-166 jbl-456 jbl-952 jbl-327 jbl-632 jbl-160 jbl-431 jbl-1020">
                        </div>
                    </div>

                    <div class="jbl-1539 jbl-748">
                        <label class="jbl-225 jbl-843 jbl-1397 jbl-431 jbl-1429">Jenis Layanan</label>
                        <select name="layanan" class="jbl-1539 jbl-434 jbl-333 jbl-121 jbl-1320 jbl-12 jbl-181 jbl-166 jbl-431 jbl-456 jbl-952 jbl-327 jbl-632 jbl-160">
                            <option value="">Semua Layanan</option>
                            <option value="KTP-el" {{ request('layanan') == 'KTP-el' ? 'selected' : '' }}>KTP-el</option>
                            <option value="KIA" {{ request('layanan') == 'KIA' ? 'selected' : '' }}>KIA</option>
                            <option value="IKD" {{ request('layanan') == 'IKD' ? 'selected' : '' }}>IKD</option>
                        </select>
                    </div>

                    <div class="jbl-1539 jbl-474">
                        <label class="jbl-225 jbl-843 jbl-1397 jbl-431 jbl-1429">Rating</label>
                        <select name="rating" class="jbl-1539 jbl-434 jbl-333 jbl-121 jbl-1320 jbl-12 jbl-181 jbl-166 jbl-431 jbl-456 jbl-952 jbl-327 jbl-632 jbl-160">
                            <option value="">Semua Rating</option>
                            <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Bintang</option>
                            <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 Bintang</option>
                            <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 Bintang</option>
                            <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 Bintang</option>
                            <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 Bintang</option>
                        </select>
                    </div>

                    <div class="jbl-1539 jbl-748">
                        <label class="jbl-225 jbl-843 jbl-1397 jbl-431 jbl-1429">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ request('tanggal') }}" 
                            class="jbl-1539 jbl-434 jbl-333 jbl-121 jbl-1320 jbl-12 jbl-181 jbl-166 jbl-456 jbl-952 jbl-327 jbl-632 jbl-160 jbl-431">
                    </div>

                    <div class="jbl-1539 jbl-577 jbl-1293 jbl-985 jbl-946">
                        <button type="submit" class="jbl-177 jbl-1294 jbl-1147 jbl-1470 jbl-1361 jbl-772 jbl-1320 jbl-433 jbl-12 jbl-166 jbl-1288 jbl-160 jbl-1293 jbl-1426 jbl-141 jbl-745">
                            <span class="material-symbols-outlined jbl-1203">search</span> Cari
                        </button>
                        
                        <a href="{{ route('admin.kepuasan.laporan') }}" class="jbl-177 jbl-1294 jbl-434 jbl-333 jbl-931 jbl-519 jbl-1418 jbl-772 jbl-12 jbl-433 jbl-1320 jbl-1293 jbl-1426 jbl-141 jbl-745 jbl-632 jbl-166 jbl-160 jbl-1306">
                            <span class="material-symbols-outlined jbl-1203">print</span> Cetak Laporan
                        </a>
                    </div>
                </form>
            </div>

            <!-- Content Grid (Table + Details Panel) -->
            <div class="jbl-174 jbl-1019 jbl-1028 jbl-1051 jbl-652">
                
                <!-- Main Table (Left Side) -->
                <div class="jbl-975 jbl-434 jbl-1406 jbl-389 jbl-333 jbl-1319 jbl-35 jbl-1293 jbl-1541">
                    <div class="jbl-1545">
                        <h2 class="jbl-210 jbl-959 jbl-386">Daftar Penilaian Masyarakat</h2>
                    </div>
                    
                    <div class="jbl-375 jbl-177 jbl-1234 jbl-1319">
                        <table class="jbl-1539 jbl-1103 jbl-325 jbl-1250">
                            <thead>
                                <tr class="jbl-1134 jbl-1049 jbl-1319 jbl-431 jbl-252 jbl-1397">
                                    <th class="jbl-156 jbl-27 jbl-1401 jbl-1397">No</th>
                                    <th class="jbl-156 jbl-1397">Nama Pemohon</th>
                                    <th class="jbl-156 jbl-1397">Jenis Layanan</th>
                                    <th class="jbl-156 jbl-1397">Rating</th>
                                    <th class="jbl-156 jbl-1397">Komentar / Saran</th>
                                    <th class="jbl-156 jbl-1397">Tanggal Penilaian</th>
                                    <th class="jbl-156 jbl-1401 jbl-1397">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="jbl-486 jbl-1408 jbl-252">
                                @forelse($reviews as $review)
                                <tr class="jbl-56 jbl-632 jbl-304 jbl-964" 
                                    @click="currentId = '{{ $review->id_kepuasan }}'; currentMasyarakat = '{{ addslashes($review->masyarakat ? ($review->masyarakat->name ?? $review->masyarakat->nama) : 'Anonim') }}'; currentLayanan = '{{ addslashes($review->status_layanan ?? '-') }}'; currentKeseluruhan = {{ (int)round($review->nilai_kepuasan) }}; currentSaran = '{{ addslashes(str_replace(["\r", "\n"], ' ', $review->kritik_saran ?? '-')) }}'; currentDate = '{{ $review->tanggal_input ? $review->tanggal_input->format('d M Y H:i') . ' WIB' : '-' }}';"
                                    :class="currentId === '{{ $review->id_kepuasan }}' ? 'bg-blue-50/50' : ''">
                                    <td class="jbl-156 jbl-1401 jbl-1574">
                                        {{ ($reviews->currentPage() - 1) * $reviews->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="jbl-156 jbl-386">
                                        {{ $review->masyarakat ? ($review->masyarakat->name ?? $review->masyarakat->nama) : 'Anonim' }}
                                    </td>
                                    <td class="jbl-156 jbl-431">
                                        {{ $review->status_layanan ?? '-' }}
                                    </td>
                                    <td class="jbl-156">
                                        <div class="jbl-1293 jbl-996 jbl-210" title="{{ $review->nilai_kepuasan }}/5">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= round($review->nilai_kepuasan))
                                                    <span class="material-symbols-outlined star-filled" style="font-variation-settings: 'FILL' 1; font-size: 16px;">star</span>
                                                @else
                                                    <span class="material-symbols-outlined star-empty" style="font-variation-settings: 'FILL' 1; font-size: 16px;">star</span>
                                                @endif
                                            @endfor
                                        </div>
                                    </td>
                                    <td class="jbl-156 jbl-1574 jbl-963 jbl-1542" title="{{ $review->kritik_saran }}">
                                        {{ $review->kritik_saran ?? '-' }}
                                    </td>
                                    <td class="jbl-156 jbl-1574 jbl-1306">
                                        {{ $review->tanggal_input ? $review->tanggal_input->format('d/m/Y H:i') : '-' }}
                                    </td>
                                    <td class="jbl-156 jbl-1401">
                                        <button class="jbl-1374 jbl-1224 jbl-140 jbl-333 jbl-935 jbl-184 jbl-1293 jbl-1426 jbl-141 jbl-819 jbl-1554 jbl-632 jbl-619 jbl-434" title="Lihat Detail">
                                            <span class="material-symbols-outlined jbl-957">visibility</span>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="jbl-1241 jbl-1401 jbl-147">Belum ada data penilaian warga.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination Area -->
                    <div class="jbl-156 jbl-1234 jbl-1319 jbl-1293 jbl-1426 jbl-1409 jbl-843 jbl-147 jbl-434">
                        <div class="jbl-565 jbl-1344 jbl-252 jbl-1574">
                            Menampilkan {{ $reviews->firstItem() ?? 0 }} sampai {{ $reviews->lastItem() ?? 0 }} dari {{ $reviews->total() }} data
                        </div>
                        <div class="jbl-177 jbl-132">
                            {{ $reviews->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                </div>

                <!-- Details Panel (Right Side) -->
                <div class="jbl-617">
                    <div class="jbl-434 jbl-1406 jbl-333 jbl-1319 jbl-389 jbl-746 jbl-846 jbl-1072">
                        <h3 class="jbl-210 jbl-959 jbl-1418 jbl-454">Detail Penilaian</h3>
                        
                        <!-- Empty State -->
                        <div x-show="!currentId" class="jbl-1401 jbl-496 jbl-181 jbl-1293 jbl-1541 jbl-1426 jbl-141 jbl-1286">
                            <div class="jbl-592 jbl-388 jbl-1134 jbl-835 jbl-1293 jbl-1426 jbl-141 jbl-870 jbl-189">
                                <span class="material-symbols-outlined jbl-47">touch_app</span>
                            </div>
                            <p class="jbl-252 jbl-147 jbl-772">Klik pada salah satu baris tabel untuk melihat detail penilaian.</p>
                        </div>

                        <!-- Content State -->
                        <div x-show="currentId" class="jbl-66" style="display: none;">
                            
                            <!-- Nama Pemohon -->
                            <div>
                                <p class="jbl-252 jbl-147 jbl-1195">Nama Pemohon</p>
                                <p class="jbl-949 jbl-386" x-text="currentMasyarakat"></p>
                            </div>

                            <!-- Jenis Layanan -->
                            <div>
                                <p class="jbl-252 jbl-147 jbl-1195">Jenis Layanan</p>
                                <p class="jbl-949 jbl-386" x-text="currentLayanan"></p>
                            </div>

                            <!-- Rating -->
                            <div>
                                <p class="jbl-252 jbl-147 jbl-1195">Rating</p>
                                <div class="jbl-1293 jbl-1426 jbl-745">
                                    <div class="jbl-1293 jbl-996 jbl-210">
                                        <template x-for="i in 5">
                                            <span class="material-symbols-outlined" 
                                                  :class="i <= currentKeseluruhan ? 'star-filled' : 'star-empty'"
                                                  style="font-variation-settings: 'FILL' 1; font-size: 18px;">star</span>
                                        </template>
                                    </div>
                                    <span class="jbl-949 jbl-386"><span x-text="currentKeseluruhan"></span> / 5</span>
                                </div>
                            </div>

                            <!-- Komentar -->
                            <div>
                                <p class="jbl-252 jbl-147 jbl-1195">Komentar</p>
                                <p class="jbl-949 jbl-386 jbl-787" x-text="currentSaran"></p>
                            </div>

                            <!-- Tanggal -->
                            <div class="jbl-192">
                                <p class="jbl-252 jbl-147 jbl-1195">Tanggal</p>
                                <p class="jbl-949 jbl-386" x-text="currentDate"></p>
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
</body>
</html>

