<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Penilaian Layanan - SI JEBOL Kota Tegal</title>
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#003178",
                        "background": "#f8faff",
                    },
                    fontFamily: { sans: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; display: inline-block; line-height: 1; vertical-align: middle; }
        body { font-family: 'Inter', sans-serif; }

        /* Star Rating */
        .star-picker { display: flex; gap: 6px; flex-direction: row-reverse; justify-content: flex-end; }
        .star-picker input { display: none; }
        .star-picker label { font-size: 2rem; color: #e2e8f0; cursor: pointer; transition: color 0.15s, transform 0.15s; line-height: 1; }
        .star-picker label:hover,
        .star-picker label:hover ~ label,
        .star-picker input:checked ~ label { color: #f59e0b; transform: scale(1.15); }

        /* Upload zone */
        .upload-zone { border: 2px dashed #cbd5e1; border-radius: 14px; padding: 24px 16px; background: #f8fafc; cursor: pointer; transition: all 0.25s; text-align: center; }
        .upload-zone:hover { border-color: #003178; background: #eff6ff; }
        .upload-zone.active { border-color: #059669; background: #f0fdf4; }

        /* Table */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table-riwayat {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .table-riwayat th {
            padding: 12px 16px;
            font-size: 0.75rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #e2e8f0;
            white-space: nowrap;
        }

        .table-riwayat td {
            padding: 16px;
            font-size: 0.85rem;
            border-bottom: 1px solid #e2e8f0;
            color: #1e293b;
        }

        .table-riwayat tr:last-child td { border-bottom: none; }

        /* Layout Grid Fixes */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-top: 32px;
            margin-bottom: 32px;
        }
        .main-grid {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 32px;
            align-items: start;
        }
        .main-content {
            flex-grow: 1;
            margin-left: 260px;
            padding: 80px 0 0;
            background: transparent;
            min-width: 0;
            transition: all 0.3s ease;
            display: flex; flex-direction: column; min-height: 100vh;
}
        .panel-card-modern {
            padding: 24px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
            border: 1px solid #e2e8f0;
        }
        @media (max-width: 1024px) {
            .main-grid { grid-template-columns: 1fr; }
            .main-content { margin-left: 0; padding: 100px 20px 0 ;     display: flex; flex-direction: column; min-height: 100vh;
}
        }
    </style>
</head>
<body class="jbl-1134 jbl-342 jbl-461" x-data="{ sidebarOpen: false, imgModalOpen: false, imgModalSrc: '' }">

    <div class="dashboard-layout jbl-1293">
        @include('partials.sidebar-masyarakat')

        <main class="main-content">

            <!-- Premium Header -->
            <div class="jbl-626 jbl-1004 jbl-454 jbl-496 jbl-1578 jbl-1298 jbl-287 jbl-1361 jbl-1109 jbl-35"
                 style="background-color: #003178; background-image: linear-gradient(rgba(0,49,120,0.9), rgba(0,49,120,0.9)), url('{{ asset('images/batik-tegal-premium.jpg') }}'); background-size: cover; border-bottom: 4px solid #f59e0b; box-shadow: 0 20px 40px rgba(0,49,120,0.15); border-radius: 0; margin-bottom: 32px;">
                <div class="jbl-91 jbl-1062 jbl-907" style="background-image: url('{{ asset('images/batik-tegal-premium.jpg') }}'); background-size: 400px; opacity: 0.12; mix-blend-mode: luminosity;"></div>
                <div class="jbl-91 jbl-3 jbl-321 jbl-1365 jbl-1468 jbl-201 jbl-1106 jbl-835 jbl-44 jbl-6 jbl-1069"></div>
                <div class="jbl-91 jbl-588 jbl-833 jbl-116 jbl-981 jbl-794 jbl-835 jbl-1518 jbl-694 jbl-780"></div>

                <div class="jbl-1109 jbl-1117 jbl-1293 jbl-1541 jbl-744 jbl-133 jbl-1051" style="padding: 32px; display: flex; align-items: center; gap: 24px;">
                    <div class="jbl-983 jbl-309 jbl-1112 jbl-1400 jbl-1406 jbl-1293 jbl-1426 jbl-141 jbl-333 jbl-777 jbl-1540 jbl-709" style="flex-shrink: 0;">
                        <span class="material-symbols-outlined jbl-766 jbl-407" style="color: #f59e0b;">star_rate</span>
                    </div>
                    <div>
                        <h1 class="jbl-264 jbl-1377 jbl-586 jbl-1511 jbl-1361 jbl-1429" style="color: white !important; margin: 0;">Penilaian <span style="color: #f59e0b;">Layanan</span></h1>
                        <p class="jbl-622 jbl-772 jbl-210 jbl-363" style="color: rgba(255,255,255,0.9) !important; margin: 8px 0 0 0;">Sampaikan pengalaman Anda terhadap layanan administrasi kependudukan SI JEBOL Kota Tegal.</p>
                    </div>
                </div>
            </div>
            <div style="padding: 0 32px 32px;">

            <!-- Alerts -->
            @if(session('status'))
            <div class="jbl-1366 jbl-1293 jbl-1426 jbl-985 jbl-433 jbl-674 jbl-313 jbl-333 jbl-439 jbl-551 jbl-1406 jbl-1397 jbl-166" style="margin-bottom: 24px;">
                <span class="material-symbols-outlined jbl-901" style="font-variation-settings:'FILL' 1">check_circle</span>
                {{ session('status') }}
            </div>
            @endif
            @if($errors->any())
            <div class="jbl-1366 jbl-433 jbl-674 jbl-656 jbl-333 jbl-1346 jbl-175 jbl-1406 jbl-166" style="margin-bottom: 24px;">
                <p class="jbl-959 jbl-1195">Terdapat Kesalahan:</p>
                <ul class="jbl-1405 jbl-692 jbl-150">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
            @endif

            @php
                $avgRating = $riwayatAll->avg('nilai_kepuasan');
                $total = $riwayatAll->count();
                $puasCount = $riwayatAll->where('nilai_kepuasan', '>=', 4)->count();
                $tingkatKepuasan = $total > 0 ? round(($puasCount / $total) * 100) : 0;
            @endphp

            <!-- Stats -->
            <div class="stats-grid">
                <div class="panel-card-modern" style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 12px; padding: 32px 24px;">
                    <div style="font-size: 2.5rem; font-weight: 800; color: #f59e0b; display: flex; align-items: center; gap: 4px; line-height: 1;">
                        {{ $avgRating ? number_format($avgRating, 1) : '—' }} 
                        <span style="font-size: 1.5rem; color: #cbd5e1;">★</span>
                    </div>
                    <p style="font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin: 0;">Rata-rata Penilaian</p>
                </div>
                <div class="panel-card-modern" style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 12px; padding: 32px 24px;">
                    <div style="font-size: 2.5rem; font-weight: 800; color: #003178; line-height: 1;">{{ $tingkatKepuasan }}%</div>
                    <p style="font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin: 0;">Tingkat Kepuasan</p>
                </div>
                <div class="panel-card-modern" style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 12px; padding: 32px 24px;">
                    <div style="font-size: 2.5rem; font-weight: 800; color: #0f172a; line-height: 1;">{{ $total }}</div>
                    <p style="font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin: 0;">Ulasan Masuk</p>
                </div>
            </div>

            <div class="main-grid">

                <!-- ===== FORM PENILAIAN ===== -->
                <div class="jbl-434 jbl-333 jbl-1319 jbl-1406 jbl-746 jbl-197 jbl-160 panel-card-modern">
                    <div class="jbl-1293 jbl-1426 jbl-985 jbl-454 jbl-513 jbl-1049 jbl-1319" style="margin-bottom: 24px; padding-bottom: 24px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; gap: 16px;">
                        <div class="jbl-800 jbl-111 jbl-676 jbl-1320 jbl-1293 jbl-1426 jbl-141" style="flex-shrink: 0; display: flex; align-items: center; justify-content: center; width: 48px; height: 48px;">
                            <span class="material-symbols-outlined jbl-1509">rate_review</span>
                        </div>
                        <div style="flex-grow: 1;">
                            <h2 class="jbl-390 jbl-657 jbl-386" style="margin: 0; line-height: 1.2;">Formulir Penilaian Layanan</h2>
                            <p class="jbl-843 jbl-13 jbl-1213" style="margin: 4px 0 0 0;">Isi form di bawah untuk mengirim penilaian Anda</p>
                        </div>
                    </div>

                    <form action="{{ route('masyarakat.kepuasan.store') }}" method="POST" enctype="multipart/form-data" class="jbl-66" style="display: flex; flex-direction: column; gap: 24px;">
                        @csrf

                        <!-- 1. Rating Layanan -->
                        <div>
                            <label class="jbl-225 jbl-166 jbl-959 jbl-431 jbl-1429">
                                Rating Layanan <span class="jbl-18">*</span>
                                <span class="jbl-418 jbl-13 jbl-843 jbl-1327">— Berikan penilaian 1 sampai 5 bintang</span>
                            </label>
                            <div class="star-picker" x-data="{ rating: 0 }">
                                @for($s = 5; $s >= 1; $s--)
                                    <input type="radio" id="star{{ $s }}" name="nilai_kepuasan" value="{{ $s }}" required @click="rating = {{ $s }}">
                                    <label for="star{{ $s }}" :style="rating >= {{ $s }} ? 'color:#f59e0b' : ''">★</label>
                                @endfor
                            </div>
                            <p class="jbl-843 jbl-1397 jbl-13 jbl-1305" id="starDesc">Klik bintang untuk memberi nilai</p>
                        </div>

                        <!-- 2. Nama Layanan -->
                        <div>
                            <label class="jbl-225 jbl-166 jbl-959 jbl-431 jbl-1429">
                                Nama Layanan <span class="jbl-18">*</span>
                                <span class="jbl-418 jbl-13 jbl-843 jbl-1327">— Pilih layanan yang sudah selesai</span>
                            </label>
                            <select class="jbl-1539 jbl-181 jbl-1569 jbl-1134 jbl-333 jbl-121 jbl-1320 jbl-85 jbl-1472 jbl-1029 jbl-1288 jbl-166 jbl-772" name="status_layanan" required>
                                <option value="" disabled {{ !old('status_layanan') && !request('layanan') ? 'selected' : '' }}>Pilih layanan yang sudah selesai...</option>
                                @if($pengajuanSelesai->isEmpty())
                                    <option value="" disabled>— Belum ada layanan yang selesai —</option>
                                @else
                                    @foreach($pengajuanSelesai as $p)
                                        @php $isSelected = old('status_layanan', request('layanan')) == $p->jenis_layanan; @endphp
                                        <option value="{{ $p->jenis_layanan }}" {{ $isSelected ? 'selected' : '' }}>
                                            {{ $p->jenis_layanan }}
                                            @if($p->nomor_tiket) — Tiket: {{ $p->nomor_tiket }} @endif
                                            @if($p->tanggal_selesai) ({{ $p->tanggal_selesai->format('d M Y') }}) @endif
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @if($pengajuanSelesai->isEmpty())
                                <p class="jbl-1305 jbl-843 jbl-1397 jbl-302">
                                    ⚠️ Belum ada layanan yang selesai. Penilaian hanya bisa diberikan untuk layanan yang sudah selesai.
                                </p>
                            @endif
                        </div>

                        <!-- 3. Nama Pemohon -->
                        <div>
                            <label class="jbl-225 jbl-166 jbl-959 jbl-431 jbl-1429">
                                Nama Pemohon
                                <span class="jbl-418 jbl-13 jbl-843 jbl-1327">— Diisi otomatis dari akun Anda</span>
                            </label>
                            <input type="text" class="jbl-1539 jbl-181 jbl-1569 jbl-995 jbl-333 jbl-121 jbl-1320 jbl-147 jbl-166 jbl-274" readonly
                                   value="{{ auth()->user()->name ?? auth()->user()->nama ?? '-' }}">
                            <input type="hidden" name="nik" value="{{ auth()->user()->nik }}">
                        </div>

                        <!-- 4. Komentar / Saran -->
                        <div>
                            <label class="jbl-225 jbl-166 jbl-959 jbl-431 jbl-1429">
                                Komentar / Saran
                                <span class="jbl-418 jbl-13 jbl-843 jbl-1327">— Pendapat Anda terhadap pelayanan</span>
                            </label>
                            <textarea class="jbl-1539 jbl-181 jbl-1569 jbl-1134 jbl-333 jbl-121 jbl-1320 jbl-85 jbl-1472 jbl-1029 jbl-1288 jbl-166 jbl-587" rows="4"
                                      name="kritik_saran" placeholder="Tuliskan pengalaman atau saran Anda untuk perbaikan layanan...">{{ old('kritik_saran') }}</textarea>
                        </div>

                        <!-- 5. Tanggal Penilaian -->
                        <div>
                            <label class="jbl-225 jbl-166 jbl-959 jbl-431 jbl-1429">
                                Tanggal Penilaian
                                <span class="jbl-418 jbl-13 jbl-843 jbl-1327">— Diisi otomatis</span>
                            </label>
                            <input type="text" class="jbl-1539 jbl-181 jbl-1569 jbl-995 jbl-333 jbl-121 jbl-1320 jbl-147 jbl-166 jbl-274" readonly
                                   value="{{ now()->translatedFormat('d F Y, H:i') }} WIB">
                        </div>

                        <!-- 6. Upload Foto -->
                        <div>
                            <label class="jbl-225 jbl-166 jbl-959 jbl-431 jbl-1429">
                                Upload Foto
                                <span class="jbl-418 jbl-13 jbl-843 jbl-1327">— Opsional, lampiran bukti atau dokumentasi</span>
                            </label>
                            <label for="foto" class="upload-zone jbl-225" id="fotoLabel">
                                <span class="material-symbols-outlined jbl-13 jbl-264 jbl-1429 jbl-225" id="fotoIcon">add_photo_alternate</span>
                                <p class="jbl-166 jbl-1397 jbl-147" id="fotoText">Klik untuk memilih foto</p>
                                <p class="jbl-843 jbl-13 jbl-1237">JPG, PNG, WEBP — maks. 5 MB</p>
                                <input type="file" id="foto" name="foto" accept="image/*" class="jbl-565" onchange="previewFoto(this)">
                            </label>
                            <div id="fotoPreview" class="jbl-565 jbl-1360 jbl-1109">
                                <img id="fotoImg" src="" alt="Preview" class="jbl-1539 jbl-155 jbl-724 jbl-1320 jbl-333 jbl-121">
                                <button type="button" onclick="clearFoto()"
                                        class="jbl-91 jbl-268 jbl-347 jbl-286 jbl-1361 jbl-835 jbl-909 jbl-707 jbl-1293 jbl-1426 jbl-141 jbl-166 jbl-1235">✕</button>
                            </div>
                        </div>

                        <!-- Hidden fields -->
                        <input type="hidden" name="rating_kecepatan" value="0">
                        <input type="hidden" name="rating_kemudahan" value="0">
                        <input type="hidden" name="rating_keramahan" value="0">
                        <input type="hidden" name="rating_kejelasan" value="0">

                        <button type="submit"
                                class="jbl-1539 jbl-1293 jbl-1426 jbl-141 jbl-745 jbl-560 jbl-1361 jbl-657 jbl-725 jbl-674 jbl-1320 jbl-1082 jbl-1101 jbl-991 jbl-1288 jbl-945">
                            <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">send</span>
                            Kirim Penilaian
                        </button>
                    </form>
                </div>

                <!-- ===== PANEL KANAN ===== -->
                <div class="jbl-1293 jbl-1541 jbl-1485">

                    <!-- Distribusi Bintang -->
                    @if($total > 0)
                    <div class="jbl-434 jbl-333 jbl-1319 jbl-1406 jbl-746 jbl-160 panel-card-modern">
                        <h3 style="margin: 0; margin-bottom: 24px; border-bottom: 1px solid #e2e8f0; padding-bottom: 16px; font-size: 1.1rem; font-weight: 800; color: #003178;">Distribusi Rating</h3>
                        @for($s = 5; $s >= 1; $s--)
                            @php $cnt = $riwayatAll->where('nilai_kepuasan', $s)->count(); $pct = $total > 0 ? ($cnt/$total*100) : 0; @endphp
                            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                                <span style="font-weight: 700; color: #f59e0b; width: 24px;">{{ $s }}★</span>
                                <div style="flex-grow: 1; height: 8px; background: #f1f5f9; border-radius: 4px; overflow: hidden;">
                                    <div style="height: 100%; background: #f59e0b; width:{{ $pct }}%; border-radius: 4px;"></div>
                                </div>
                                <span style="font-size: 0.85rem; font-weight: 600; color: #64748b; width: 24px; text-align: right;">{{ $cnt }}</span>
                            </div>
                        @endfor
                    </div>
                    @endif

                    <!-- Riwayat Penilaian -->
                    <div class="panel-card-modern" style="margin-top: 32px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; border-bottom: 1px solid #e2e8f0; padding-bottom: 16px;">
                            <h3 style="margin: 0; font-size: 1.1rem; font-weight: 800; color: #003178;">Daftar Ulasan</h3>
                            <span style="background: #003178; color: white; font-size: 0.75rem; font-weight: 700; padding: 0 12px; height: 24px; display: inline-flex; align-items: center; justify-content: center; border-radius: 12px; letter-spacing: 0.5px;">{{ $total }} data</span>
                        </div>

                        <!-- Riwayat Cards -->
                        @if($riwayat->isEmpty())
                        <div class="jbl-434 jbl-333 jbl-1319 jbl-1406 jbl-1081 jbl-1401 jbl-160" style="padding: 32px; text-align: center;">
                            <span class="material-symbols-outlined jbl-766 jbl-189 jbl-225 jbl-897" style="font-size: 48px; color: #cbd5e1; margin-bottom: 16px;">star_border</span>
                            <p class="jbl-13 jbl-1397" style="color: #64748b;">Belum ada penilaian yang dikirim.</p>
                        </div>
                        @else
                        <div class="table-responsive">
                            <table class="table-riwayat">
                                <thead>
                                    <tr>
                                        <th>Waktu</th>
                                        <th>Pemohon</th>
                                        <th>Layanan</th>
                                        <th style="text-align: center;">Rating</th>
                                        <th>Komentar & Lampiran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($riwayat as $item)
                                    <tr>
                                        <td>
                                            {{ $item->tanggal_input ? $item->tanggal_input->format('d M Y, H:i') : '-' }} WIB
                                        </td>
                                        <td style="font-weight: 600;">
                                            {{ $item->masyarakat->name ?? $item->masyarakat->nama ?? 'Anonim' }}
                                        </td>
                                        <td style="font-weight: 600;">
                                            {{ $item->status_layanan ?? '-' }}
                                        </td>
                                        <td style="text-align: center;">
                                            <div style="display: flex; align-items: center; justify-content: center; gap: 4px;">
                                                <span style="font-weight: 700; color: #f59e0b;">{{ number_format($item->nilai_kepuasan, 1) }}</span>
                                                <span style="color: #f59e0b; font-size: 1.1rem;">★</span>
                                            </div>
                                        </td>
                                        <td>
                                            @if($item->kritik_saran)
                                                <p style="font-style: italic; color: #64748b; margin: 0 0 8px 0;">"{{ Str::limit($item->kritik_saran, 80) }}"</p>
                                            @else
                                                <span style="color: #cbd5e1;">-</span>
                                            @endif
                                            
                                            @if($item->foto_path)
                                                <div class="jbl-1305">
                                                    <button type="button" @click="imgModalSrc = '{{ Storage::url($item->foto_path) }}'; imgModalOpen = true" class="jbl-823 jbl-843 jbl-959 jbl-1066 jbl-1023 jbl-602 jbl-1426 jbl-995 jbl-212 jbl-262 jbl-145 jbl-1300 jbl-632">
                                                        <span class="material-symbols-outlined jbl-949">image</span> Lihat Lampiran
                                                    </button>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    
                    <div class="jbl-652 jbl-1293 jbl-141">
                        {{ $riwayat->links() }}
                    </div>
                    @endif
                    </div> <!-- Close panel-card-modern for Daftar Ulasan -->

                </div>
            </div>
            </div> <!-- Close the padding container -->

                    <!-- Global Footer -->
            <div style="margin-top: auto; padding: 24px; background: white; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; font-size: 0.75rem; color: #64748b;">
                <div>&copy; 2026 Dinas Kependudukan dan Pencatatan Sipil Kota Tegal. All rights reserved.</div>
                <div style="display:flex; gap:16px;">
                    <a href="#" style="color:#64748b; text-decoration:none;">Kebijakan Privasi</a>
                    <a href="#" style="color:#64748b; text-decoration:none;">Syarat & Ketentuan</a>
                </div>
            </div>
        </main>
    </div>

    <script>
        lucide.createIcons();

        const starDescs = { 1:'Sangat Buruk 😡', 2:'Kurang Puas 😕', 3:'Cukup Puas 😐', 4:'Puas 😊', 5:'Sangat Puas 😍' };
        document.querySelectorAll('.star-picker input').forEach(input => {
            input.addEventListener('change', () => {
                document.getElementById('starDesc').textContent = starDescs[input.value] || '';
            });
        });

        function previewFoto(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    document.getElementById('fotoImg').src = e.target.result;
                    document.getElementById('fotoPreview').classList.remove('hidden');
                    document.getElementById('fotoIcon').textContent = 'check_circle';
                    document.getElementById('fotoIcon').style.color = '#059669';
                    document.getElementById('fotoText').textContent = input.files[0].name;
                    document.getElementById('fotoLabel').classList.add('active');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function clearFoto() {
            document.getElementById('foto').value = '';
            document.getElementById('fotoPreview').classList.add('hidden');
            document.getElementById('fotoImg').src = '';
            document.getElementById('fotoIcon').textContent = 'add_photo_alternate';
            document.getElementById('fotoIcon').style.color = '';
            document.getElementById('fotoText').textContent = 'Klik untuk memilih foto';
            document.getElementById('fotoLabel').classList.remove('active');
        }
    </script>

    <!-- Image Modal -->
    <div x-cloak x-show="imgModalOpen" class="jbl-524 jbl-1062 jbl-377 jbl-1293 jbl-1426 jbl-141 jbl-294 jbl-637 jbl-156" @keydown.escape.window="imgModalOpen = false">
        <div class="jbl-1109 jbl-151 jbl-1539 jbl-1293 jbl-141" @click.away="imgModalOpen = false">
            <button type="button" @click="imgModalOpen = false" class="jbl-91 jbl-1435 jbl-321 jbl-666 jbl-1361 jbl-1437 jbl-632">
                <span class="material-symbols-outlined jbl-264">close</span>
            </button>
            <img :src="imgModalSrc" class="jbl-135 jbl-241 jbl-481 jbl-920 jbl-1320 jbl-641 jbl-57" alt="Lampiran">
        </div>
    </div>
</body>
</html>

