@extends('layouts.masyarakat')

@push('styles')
<style>
.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; display: inline-block; line-height: 1; vertical-align: middle; }
        
        

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
        
        .panel-card-modern {
            padding: 24px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
            border: 1px solid #e2e8f0;
        }
        @media (max-width: 1024px) {
            .main-grid { grid-template-columns: 1fr; }
            .responsive-header {
                margin: -16px -16px 32px -16px !important;
            }
        }
        @media (max-width: 768px) {
            .responsive-header {
                margin: -16px -16px 16px -16px !important;
                border-radius: 0 !important;
                width: calc(100% + 32px) !important;
                display: block !important;
                position: relative !important;
                overflow: hidden !important;
            }
            .responsive-header-inner {
                padding: 24px 16px !important;
                flex-direction: column !important;
                align-items: center !important;
                text-align: center;
                gap: 16px !important;
                width: 100% !important;
                box-sizing: border-box !important;
            }
            .responsive-header-text {
                width: 100% !important;
                max-width: 100% !important;
                overflow-wrap: break-word !important;
                word-wrap: break-word !important;
                white-space: normal !important;
            }
            .responsive-header-text h1 {
                font-size: 1.5rem !important;
                line-height: 1.3 !important;
            }
            .responsive-header-text p {
                font-size: 0.85rem !important;
            }
            .responsive-body {
                padding: 0 !important;
            }
        }

        /* Premium Form Styles */
        .form-group { display: flex; flex-direction: column; gap: 8px; margin-bottom: 24px; }
        .form-group:last-child { margin-bottom: 0; }
        
        .form-label { font-size: 0.85rem; font-weight: 700; color: #1e293b; display: flex; flex-direction: column; gap: 4px; }
        .form-label .hint { font-size: 0.75rem; font-weight: 400; color: #64748b; }
        
        .form-control { 
            width: 100%; 
            padding: 12px 16px; 
            border-radius: 12px; 
            border: 1px solid #cbd5e1; 
            background: white; 
            font-family: inherit; 
            font-size: 0.95rem; 
            outline: none; 
            transition: all 0.2s; 
            box-sizing: border-box;
            color: #1e293b;
        }
        .form-control:focus { border-color: #003178; box-shadow: 0 0 0 3px rgba(0, 49, 120, 0.1); }
        .form-control:disabled, .form-control[readonly] { background: #f8fafc; color: #94a3b8; cursor: not-allowed; }
        
        .btn-primary { 
            background: #003178; 
            color: white; 
            padding: 14px 24px; 
            border-radius: 12px; 
            font-weight: 600; 
            font-size: 1rem; 
            border: none; 
            cursor: pointer; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            gap: 8px; 
            transition: all 0.2s; 
            width: 100%; 
        }
        .btn-primary:hover { background: #002255; transform: translateY(-2px); }
        .form-hint { font-size: 0.8rem; color: #64748b; margin-top: 4px; }
    </style>
@endpush

@section('content')
<div x-data="{ imgModalOpen: false, imgModalSrc: '' }">
<!-- Premium Header -->
            <div class="jbl-626 jbl-1004 jbl-454 jbl-496 jbl-1578 jbl-1298 jbl-287 jbl-1361 jbl-1109 jbl-35 responsive-header"
                 style="background-color: #003178; background-image: linear-gradient(rgba(0,49,120,0.9), rgba(0,49,120,0.9)), url('{{ asset('images/batik-tegal-premium.jpg') }}'); background-size: cover; border-bottom: 4px solid #f59e0b; box-shadow: 0 20px 40px rgba(0,49,120,0.15); border-radius: 0; margin: -24px -24px 32px -24px;">
                <div class="jbl-91 jbl-1062 jbl-907" style="background-image: url('{{ asset('images/batik-tegal-premium.jpg') }}'); background-size: 400px; opacity: 0.12; mix-blend-mode: luminosity;"></div>
                <div class="jbl-91 jbl-3 jbl-321 jbl-1365 jbl-1468 jbl-201 jbl-1106 jbl-835 jbl-44 jbl-6 jbl-1069"></div>
                <div class="jbl-91 jbl-588 jbl-833 jbl-116 jbl-981 jbl-794 jbl-835 jbl-1518 jbl-694 jbl-780"></div>

                <div class="jbl-1109 jbl-1117 jbl-1293 jbl-1541 jbl-744 jbl-133 jbl-1051 responsive-header-inner" style="padding: 32px; display: flex; align-items: center; gap: 24px;">
                    <div class="jbl-983 jbl-309 jbl-1112 jbl-1400 jbl-1406 jbl-1293 jbl-1426 jbl-141 jbl-333 jbl-777 jbl-1540 jbl-709" style="flex-shrink: 0;">
                        <span class="material-symbols-outlined jbl-766 jbl-407" style="color: #f59e0b;">star_rate</span>
                    </div>
                    <div class="responsive-header-text">
                        <h1 class="jbl-264 jbl-1377 jbl-586 jbl-1511 jbl-1361 jbl-1429" style="color: white !important; margin: 0;">Penilaian <span style="color: #f59e0b;">Layanan</span></h1>
                        <p class="jbl-622 jbl-772 jbl-210 jbl-363" style="color: rgba(255,255,255,0.9) !important; margin: 8px 0 0 0;">Sampaikan pengalaman Anda terhadap layanan administrasi kependudukan SI JEBOL Kota Tegal.</p>
                    </div>
                </div>
            </div>
            <div class="responsive-body" style="padding: 0 16px 32px;">

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
                        <div class="form-group">
                            <label class="form-label">
                                Rating Layanan <span style="color: #ef4444;">*</span>
                                <span class="hint">— Berikan penilaian 1 sampai 5 bintang</span>
                            </label>
                            <div class="star-picker" x-data="{ rating: 0 }">
                                @for($s = 5; $s >= 1; $s--)
                                    <input type="radio" id="star{{ $s }}" name="nilai_kepuasan" value="{{ $s }}" required @click="rating = {{ $s }}">
                                    <label for="star{{ $s }}" :style="rating >= {{ $s }} ? 'color:#f59e0b' : ''">★</label>
                                @endfor
                            </div>
                            <p class="form-hint" id="starDesc">Klik bintang untuk memberi nilai</p>
                        </div>

                        <!-- 2. Nama Layanan -->
                        <div class="form-group">
                            <label class="form-label">
                                Nama Layanan <span style="color: #ef4444;">*</span>
                                <span class="hint">— Pilih layanan yang sudah selesai</span>
                            </label>
                            <select class="form-control" name="status_layanan" required>
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
                                <p class="form-hint" style="color: #ef4444;">
                                    ⚠️ Belum ada layanan yang selesai. Penilaian hanya bisa diberikan untuk layanan yang sudah selesai.
                                </p>
                            @endif
                        </div>

                        <!-- 3. Nama Pemohon -->
                        <div class="form-group">
                            <label class="form-label">
                                Nama Pemohon
                                <span class="hint">— Diisi otomatis dari akun Anda</span>
                            </label>
                            <input type="text" class="form-control" readonly
                                   value="{{ auth()->user()->name ?? auth()->user()->nama ?? '-' }}">
                            <input type="hidden" name="nik" value="{{ auth()->user()->nik }}">
                        </div>

                        <!-- 4. Komentar / Saran -->
                        <div class="form-group">
                            <label class="form-label">
                                Komentar / Saran
                                <span class="hint">— Pendapat Anda terhadap pelayanan</span>
                            </label>
                            <textarea class="form-control" rows="4"
                                      name="kritik_saran" placeholder="Tuliskan pengalaman atau saran Anda untuk perbaikan layanan...">{{ old('kritik_saran') }}</textarea>
                        </div>

                        <!-- 5. Tanggal Penilaian -->
                        <div class="form-group">
                            <label class="form-label">
                                Tanggal Penilaian
                                <span class="hint">— Diisi otomatis</span>
                            </label>
                            <input type="text" class="form-control" readonly
                                   value="{{ now()->translatedFormat('d F Y, H:i') }} WIB">
                        </div>

                        <!-- 6. Upload Foto -->
                        <div class="form-group">
                            <label class="form-label">
                                Upload Foto
                                <span class="hint">— Opsional, lampiran bukti atau dokumentasi</span>
                            </label>
                            <label for="foto" class="upload-zone" id="fotoLabel">
                                <span class="material-symbols-outlined" style="font-size: 2rem; color: #94a3b8; margin-bottom: 8px;" id="fotoIcon">add_photo_alternate</span>
                                <p style="font-weight: 700; color: #003178; margin: 0 0 4px 0;" id="fotoText">Klik untuk memilih foto</p>
                                <p style="font-size: 0.8rem; color: #64748b; margin: 0;">JPG, PNG, WEBP — maks. 5 MB</p>
                                <input type="file" id="foto" name="foto" accept="image/*" style="display: none;" onchange="previewFoto(this)">
                            </label>
                            <div id="fotoPreview" style="display: none; position: relative; width: 120px; height: 120px; border-radius: 12px; overflow: hidden; border: 2px solid #e2e8f0;">
                                <img id="fotoImg" src="" alt="Preview" style="width: 100%; height: 100%; object-fit: cover;">
                                <button type="button" onclick="clearFoto()"
                                        style="position: absolute; top: 4px; right: 4px; background: rgba(0,0,0,0.5); color: white; border: none; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 0.8rem;">✕</button>
                            </div>
                        </div>

                        <!-- Hidden fields -->
                        <input type="hidden" name="rating_kecepatan" value="0">
                        <input type="hidden" name="rating_kemudahan" value="0">
                        <input type="hidden" name="rating_keramahan" value="0">
                        <input type="hidden" name="rating_kejelasan" value="0">

                        <button type="submit" class="btn-primary" style="margin-top: 16px;">
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
                    
                    <div style="display: flex; margin-top: 24px; justify-content: flex-end;">
                        {{ $riwayat->links() }}
                    </div>
                    @endif
                    </div> <!-- Close panel-card-modern for Daftar Ulasan -->

                </div>
            </div>
            </div> <!-- Close the padding container -->
            
            <!-- Image Modal -->
            <div x-show="imgModalOpen" style="display: none; position: fixed; inset: 0; z-index: 9999; background: rgba(15, 23, 42, 0.9); display: flex; align-items: center; justify-content: center; backdrop-filter: blur(4px); padding: 40px;" x-transition>
                <div @click.away="imgModalOpen = false" style="position: relative; max-width: 100%; max-height: 100%; display: flex; justify-content: center; align-items: center;">
                    <button @click="imgModalOpen = false" style="position: absolute; top: -16px; right: -16px; background: #0f172a; color: white; border: 2px solid white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.3); z-index: 10000; font-weight: bold; font-size: 1.2rem; transition: all 0.2s;" onmouseover="this.style.background='#ef4444'; this.style.transform='scale(1.1)';" onmouseout="this.style.background='#0f172a'; this.style.transform='scale(1)';">✕</button>
                    <img :src="imgModalSrc" style="max-width: 100%; max-height: 85vh; border-radius: 12px; object-fit: contain; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);">
                </div>
            </div>
</div>
@endsection