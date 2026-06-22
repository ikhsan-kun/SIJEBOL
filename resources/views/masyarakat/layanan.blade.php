<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan - JEBOL</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root {
            --primary: #003178;
            --primary-light: #e0f2fe;
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        body {
            background-color: #f8faff;
            background-image: url('{{ asset('img/batik-pattern.png') }}');
            background-size: 400px;
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            margin: 0;
        }

        /* Sidebar Layout Integration */
        .dashboard-layout {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex-grow: 1;
            margin-left: 260px;
            padding: 80px 48px 0 ;
            background: #f4f7fb;
            min-width: 0;
            transition: all 0.3s ease;
            display: flex; flex-direction: column; min-height: 100vh;
}

        @media (max-width: 1024px) {
            .main-content {
                margin-left: 0;
                padding: 100px 20px 0 ;
                display: flex; flex-direction: column; min-height: 100vh;
}
        }

        .hero-banner {
            background: #003178;
            color: white;
            overflow: hidden;
            box-shadow: 0 20px 40px -15px rgba(0, 49, 120, 0.2);
            position: relative;
        
            border-radius: 0;
            padding: 48px 96px;
            margin: 0 -48px 40px -48px;
            border-bottom: 4px solid #F59E0B;
        }

        .hero-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('{{ asset("images/batik-tegal-premium.jpg") }}');
            background-size: cover;
            background-position: center;
            opacity: 0.15;
            mix-blend-mode: luminosity;
            pointer-events: none;
        }

        .hero-banner h1 {
            font-size: 3rem !important;
            font-weight: 900 !important;
            line-height: 1.1 !important;
            margin-bottom: 16px !important;
            color: white !important;
            letter-spacing: -1.5px !important;
        }

        @media (max-width: 1024px) {
            .hero-banner {
                margin: 0 -20px 40px -20px;
                padding: 40px 40px;
                border-radius: 0;
            }
        }

        @media (max-width: 768px) {
            .hero-banner { padding: 32px 20px; border-radius: 0; }
            .hero-banner h1 { font-size: 2.2rem !important; }
            .hero-banner p { font-size: 1rem !important; }
        }

        .hero-banner p {
            font-size: 1.1rem !important;
            max-width: 600px !important;
            color: rgba(255,255,255,0.8) !important;
            margin-bottom: 0 !important;
            line-height: 1.6 !important;
        }

        .main-layout {
            max-width: 100%;
            margin: 0;
            padding: 0;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 32px;
        }

        .services-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .premium-service-card {
            background: white;
            border-radius: 32px;
            padding: 40px;
            border: 1px solid rgba(0, 49, 120, 0.05);
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        .premium-service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 60px rgba(0, 49, 120, 0.1);
            border-color: var(--primary);
        }

        .card-icon-box {
            width: 60px;
            height: 60px;
            background: #fdfdfe;
            border: 1px solid #f1f5f9;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            margin-bottom: 24px;
            transition: all 0.3s;
        }

        .premium-service-card:hover .card-icon-box {
            background: var(--primary);
            color: white;
            transform: rotate(-5deg) scale(1.1);
        }

        .premium-service-card h3 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #000000;
            margin-bottom: 12px;
            font-family: 'Inter', sans-serif;
            letter-spacing: -0.5px;
        }

        .premium-service-card p {
            font-size: 0.9rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 32px;
            flex: 1;
        }

        .status-pill {
            display: inline-flex;
            padding: 4px 12px;
            background: #f0fdf4;
            color: #15803d;
            border-radius: 100px;
            font-size: 0.65rem;
            font-weight: 900;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }

        .btn-action-main {
            background: var(--primary);
            color: white;
            padding: 16px;
            border-radius: 16px;
            font-weight: 700;
            text-align: center;
            transition: all 0.2s;
            margin-top: auto;
            display: block;
        }

        .btn-action-main:hover {
            background: var(--primary-dark);
            transform: scale(1.02);
            box-shadow: 0 10px 20px rgba(0, 49, 120, 0.2);
        }

        .btn-action-secondary {
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 700;
            text-align: center;
            margin-top: 16px;
            transition: all 0.2s;
        }

        .btn-action-secondary:hover {
            color: var(--primary);
        }

        /* Sidebar Styles */
        .sidebar-premium {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .info-premium-card {
            background: white;
            border-radius: 32px;
            padding: 32px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        }

        .info-premium-card h4 {
            font-size: 1.1rem;
            font-weight: 800;
            color: #000000;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .req-step {
            display: flex;
            gap: 16px;
            margin-bottom: 20px;
        }

        .step-num {
            width: 28px;
            height: 28px;
            background: var(--primary-light);
            color: var(--primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 0.8rem;
            flex-shrink: 0;
        }

        .req-step p {
            font-size: 0.85rem;
            color: var(--text-main);
            font-weight: 500;
            line-height: 1.5;
        }

        .help-banner-modern {
            background: #ffffff;
            border-radius: 32px;
            padding: 32px;
            color: var(--text-main);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0, 49, 120, 0.05);
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        }

        .help-banner-modern h4 {
            font-size: 1.25rem;
            font-weight: 900;
            color: var(--primary);
            margin-bottom: 12px;
            position: relative;
            z-index: 2;
        }

        .help-banner-modern p {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 24px;
            position: relative;
            z-index: 2;
        }

        .btn-white-glass {
            background: var(--primary);
            color: white;
            padding: 12px 24px;
            border-radius: 100px;
            font-weight: 700;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            position: relative;
            z-index: 2;
        }

        .btn-white-glass:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .bg-pattern {
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 2px, transparent 0);
            background-size: 15px 15px;
            z-index: 1;
        }

        @media (max-width: 1024px) {
            .main-layout { grid-template-columns: 1fr; }
            .hero-banner h1 { font-size: 2.5rem; }
            .services-grid { 
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 16px;
            }
        }

        @media (max-width: 768px) {
            .services-grid { 
                grid-template-columns: 1fr 1fr;
                gap: 12px; 
            }
            .premium-service-card { 
                padding: 16px; 
                border-radius: 16px; 
                display: flex;
                flex-direction: column;
                min-width: unset;
                max-width: unset;
            }
            .premium-service-card h3 {
                font-size: 1rem;
                margin-bottom: 8px;
                line-height: 1.2;
                text-align: left;
            }
            .premium-service-card p {
                font-size: 0.75rem;
                margin-bottom: 16px;
                line-height: 1.4;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
            .card-icon-box {
                width: 40px;
                height: 40px;
                margin-bottom: 12px;
                border-radius: 12px;
                margin-left: 0;
                margin-right: 0;
            }
            .card-icon-box .material-symbols-outlined {
                font-size: 20px !important;
            }
            .status-pill {
                padding: 4px 8px;
                font-size: 0.6rem;
                margin-bottom: 12px;
                align-self: flex-start;
            }
            .btn-action-main {
                padding: 10px;
                font-size: 0.8rem;
                border-radius: 10px;
                text-align: center;
                margin-top: auto;
            }
            .btn-action-secondary {
                display: block;
                font-size: 0.75rem;
                margin-top: 10px;
            }
        }
    </style>
</head>
<body x-data="{ sidebarOpen: false, showDetailModal: false, activeService: '' }">
    

    <div class="dashboard-layout">
        @include('partials.sidebar-masyarakat')

        <main class="main-content">
            <section class="hero-banner">
                <div class="jbl-1109 jbl-1117 jbl-1401 jbl-1293 jbl-1541 jbl-1426 jbl-141">
                    <h1>Layanan <span style="color: #F59E0B;">SI JEBOL</span></h1>
                    <p style="margin-left: auto !important; margin-right: auto !important;">Pilih layanan administrasi kependudukan yang Anda butuhkan dengan mudah, cepat, dan aman.</p>
                </div>
                <div class="jbl-91 jbl-726 jbl-256 jbl-1167 jbl-1117 jbl-565 jbl-195 jbl-6">
                    <span class="material-symbols-outlined" style="font-size: 180px; color: white;">verified_user</span>
                </div>
            </section>

   

            <div class="main-layout">
        <!-- Left: Services -->
        <div class="services-grid">
            @forelse($services as $service)
            <div class="premium-service-card">
                <span class="status-pill">{{ strtoupper($service->status) }}</span>
                <div class="card-icon-box">
                    <span class="material-symbols-outlined jbl-47">{{ $service->icon ?? 'description' }}</span>
                </div>
                <h3>{{ $service->name }}</h3>
                <p>Urus dokumen kependudukan Anda secara online dengan estimasi waktu penyelesaian <strong>{{ $service->estimation ?? '1-3 Hari Kerja' }}</strong>.</p>
                <a href="{{ route('pengajuan', ['layanan' => $service->name]) }}" class="btn-action-main">Ajukan Sekarang</a>
                <button @click.prevent="showDetailModal = true; activeService = '{{ addslashes($service->name) }}'" class="btn-action-secondary">Lihat Detail & Syarat</button>
            </div>
            @empty
            <div class="jbl-834 jbl-1081 jbl-1401 jbl-434 jbl-1382 jbl-333 jbl-400 jbl-121">
                <span class="material-symbols-outlined jbl-766 jbl-189 jbl-870">settings_suggest</span>
                <p class="jbl-147 jbl-959">Maaf, saat ini belum ada layanan aktif yang tersedia.</p>
            </div>
            @endforelse
        </div>

        <!-- Right: Sidebar -->
        <div class="sidebar-premium">
            <div class="info-premium-card">
                <h4>
                    <span class="material-symbols-outlined">description</span>
                    Persyaratan Umum
                </h4>
                <div class="req-step">
                    <div class="step-num">01</div>
                    <p>Mempunyai akun SI JEBOL yang telah terverifikasi NIK-nya.</p>
                </div>
                <div class="req-step">
                    <div class="step-num Explorer">02</div>
                    <p>Dokumen asli harus dipindai (scan) dengan jelas dan berwarna.</p>
                </div>
                <div class="req-step">
                    <div class="step-num">03</div>
                    <p>Format file: JPG/PDF dengan ukuran maksimal 2MB per file.</p>
                </div>
                <div class="req-step">
                    <div class="step-num">04</div>
                    <p>Pastikan Nomor WhatsApp aktif untuk notifikasi status berkas.</p>
                </div>
            </div>

            <div class="help-banner-modern">
                <div class="bg-pattern"></div>
                <h4>Butuh Bantuan Teknis?</h4>
                <p>Tim dukungan kami siap membantu Anda menyelesaikan kendala pengajuan dokumen Anda.</p>
                <a href="#" class="btn-white-glass">
                    <i data-lucide="message-circle" width="18" height="18"></i>
                    WhatsApp Support
                </a>
            </div>
        </div>
            </div>
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

    <!-- Alpine JS Modal for Detail & Syarat -->
    <div x-show="showDetailModal" class="jbl-524 jbl-1062 jbl-377 jbl-685" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
        <!-- Background backdrop -->
        <div x-show="showDetailModal" 
             x-transition:enter="ease-out duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100" 
             x-transition:leave="ease-in duration-200" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0" 
             class="jbl-524 jbl-1062 jbl-1085 jbl-637 jbl-729" 
             @click="showDetailModal = false"></div>

        <div class="jbl-1293 jbl-167 jbl-1426 jbl-141 jbl-156 jbl-1401 jbl-282">
            <!-- Modal panel -->
            <div x-show="showDetailModal" 
                 x-transition:enter="ease-out duration-300" 
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave="ease-in duration-200" 
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 class="jbl-1109 jbl-753 jbl-35 jbl-1382 jbl-434 jbl-1103 jbl-641 jbl-1288 jbl-1447 jbl-690 jbl-997 jbl-333 jbl-1319">
                
                <!-- Modal Header -->
                <div class="jbl-1547 jbl-725 jbl-371 jbl-1293 jbl-1426 jbl-1409 jbl-1109 jbl-35">
                    <div class="jbl-91 jbl-1062 jbl-6 bg-[url('{{ asset('img/batik-pattern.png') }}')] bg-cover"></div>
                    <div class="jbl-1109 jbl-1117 jbl-1293 jbl-1426 jbl-985 jbl-1361">
                        <i data-lucide="file-text" width="24" height="24"></i>
                        <h3 class="jbl-390 jbl-959 jbl-1361" id="modal-title" x-text="'Persyaratan ' + activeService">Detail & Syarat</h3>
                    </div>
                    <button @click="showDetailModal = false" class="jbl-1109 jbl-1117 jbl-860 jbl-1554 jbl-632 jbl-1112 jbl-1296 jbl-518 jbl-835">
                        <i data-lucide="x" width="20" height="20"></i>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="jbl-725 jbl-1078 jbl-1134 jbl-99 jbl-685">
                    
                    <!-- KTP-el Specific Content -->
                    <div x-show="activeService.includes('KTP')" style="display: none;">
                        <div class="jbl-1342">
                            <!-- Persyaratan -->
                            <div>
                                <h4 class="jbl-1080 jbl-959 jbl-497 jbl-1462 jbl-422 jbl-897 jbl-1293 jbl-1426 jbl-745">
                                    <i data-lucide="check-square" width="16"></i> Persyaratan Pelayanan
                                </h4>
                                <div class="jbl-434 jbl-1406 jbl-1545 jbl-333 jbl-121 jbl-160 jbl-285">
                                    <div>
                                        <p class="jbl-959 jbl-386 jbl-166 jbl-1429">Pengurusan KTP-el Baru:</p>
                                        <ul class="jbl-1405 jbl-660 jbl-166 jbl-1574 jbl-1327 jbl-1003">
                                            <li>Fotocopy Kartu Keluarga (KK)</li>
                                        </ul>
                                    </div>
                                    <div class="jbl-1378 jbl-1234 jbl-1319">
                                        <p class="jbl-959 jbl-386 jbl-166 jbl-1429">Cetak KTP-el Pengganti:</p>
                                        <ul class="jbl-1405 jbl-660 jbl-166 jbl-1574 jbl-1327 jbl-1003">
                                            <li>Fotocopy Kartu Keluarga (KK)</li>
                                            <li>Membawa KTP-el yang rusak (jika karena rusak)</li>
                                            <li>Surat Kehilangan dari Kepolisian (jika hilang)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Prosedur Removed as requested -->

                            <!-- Waktu & Biaya -->
                            <div class="jbl-174 jbl-1576 jbl-701">
                                <div class="jbl-434 jbl-1406 jbl-156 jbl-333 jbl-121 jbl-160">
                                    <p class="jbl-843 jbl-959 jbl-13 jbl-1462 jbl-1195">Jangka Waktu</p>
                                    <p class="jbl-166 jbl-959 jbl-386"><i data-lucide="clock" width="14" class="jbl-1189 jbl-1381 jbl-1457"></i> 2 Hari Kerja</p>
                                </div>
                                <div class="jbl-434 jbl-1406 jbl-156 jbl-333 jbl-121 jbl-160">
                                    <p class="jbl-843 jbl-959 jbl-13 jbl-1462 jbl-1195">Biaya / Tarif</p>
                                    <p class="jbl-166 jbl-959 jbl-625"><i data-lucide="check-circle" width="14" class="jbl-1189 jbl-1457"></i> GRATIS</p>
                                </div>
                            </div>

                            <!-- Dasar Hukum -->
                            <div>
                                <h4 class="jbl-1080 jbl-959 jbl-497 jbl-1462 jbl-422 jbl-1429 jbl-1293 jbl-1426 jbl-745">
                                    <i data-lucide="book-open" width="16"></i> Dasar Hukum
                                </h4>
                                <div class="jbl-995 jbl-1320 jbl-156 jbl-596 jbl-147 jbl-1003">
                                    <p>1. UU No. 24 Tahun 2013 tentang perubahan atas UU No. 23 Th. 2006 tentang Administrasi Kependudukan.</p>
                                    <p>2. Perpres No. 96 Tahun 2018 Tentang Persyaratan dan Tata Cara Pendaftaran Penduduk dan Pencatatan Sipil.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- KIA Specific Content -->
                    <div x-show="activeService.includes('KIA')" style="display: none;">
                        <div class="jbl-1342">
                            <!-- Persyaratan -->
                            <div>
                                <h4 class="jbl-1080 jbl-959 jbl-497 jbl-1462 jbl-422 jbl-897 jbl-1293 jbl-1426 jbl-745">
                                    <i data-lucide="check-square" width="16"></i> Persyaratan Pelayanan
                                </h4>
                                <div class="jbl-434 jbl-1406 jbl-1545 jbl-333 jbl-121 jbl-160 jbl-285">
                                    <div>
                                        <p class="jbl-959 jbl-386 jbl-166 jbl-1429">Penerbitan KIA Baru:</p>
                                        <ul class="jbl-1405 jbl-660 jbl-166 jbl-1574 jbl-1327 jbl-1003">
                                            <li>Fotocopy Kutipan Akta Kelahiran</li>
                                            <li>Fotocopy KK Orang Tua/Wali</li>
                                            <li>Fotocopy KTP-el kedua Orang Tua/Wali</li>
                                            <li>Pas Foto Anak berwarna ukuran 2x3 (khusus usia 5 - 17 tahun kurang satu hari)</li>
                                        </ul>
                                    </div>
                                    <div class="jbl-1378 jbl-1234 jbl-1319">
                                        <p class="jbl-959 jbl-386 jbl-166 jbl-1429">Penerbitan KIA Pengganti:</p>
                                        <ul class="jbl-1405 jbl-660 jbl-166 jbl-1574 jbl-1327 jbl-1003">
                                            <li>Membawa KIA yang rusak (jika karena rusak)</li>
                                            <li>Surat Kehilangan dari Kepolisian (jika hilang)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Waktu & Biaya -->
                            <div class="jbl-174 jbl-1576 jbl-701">
                                <div class="jbl-434 jbl-1406 jbl-156 jbl-333 jbl-121 jbl-160">
                                    <p class="jbl-843 jbl-959 jbl-13 jbl-1462 jbl-1195">Jangka Waktu</p>
                                    <p class="jbl-166 jbl-959 jbl-386"><i data-lucide="clock" width="14" class="jbl-1189 jbl-1381 jbl-1457"></i> 2 Hari Kerja</p>
                                </div>
                                <div class="jbl-434 jbl-1406 jbl-156 jbl-333 jbl-121 jbl-160">
                                    <p class="jbl-843 jbl-959 jbl-13 jbl-1462 jbl-1195">Biaya / Tarif</p>
                                    <p class="jbl-166 jbl-959 jbl-625"><i data-lucide="check-circle" width="14" class="jbl-1189 jbl-1457"></i> GRATIS</p>
                                </div>
                            </div>

                            <!-- Dasar Hukum -->
                            <div>
                                <h4 class="jbl-1080 jbl-959 jbl-497 jbl-1462 jbl-422 jbl-1429 jbl-1293 jbl-1426 jbl-745">
                                    <i data-lucide="book-open" width="16"></i> Dasar Hukum
                                </h4>
                                <div class="jbl-995 jbl-1320 jbl-156 jbl-596 jbl-147 jbl-1003">
                                    <p>1. Permendagri No. 2 Tahun 2016 tentang Kartu Identitas Anak.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- IKD Specific Content -->
                    <div x-show="activeService.includes('IKD')" style="display: none;">
                        <div class="jbl-1342">
                            <!-- Persyaratan -->
                            <div>
                                <h4 class="jbl-1080 jbl-959 jbl-497 jbl-1462 jbl-422 jbl-897 jbl-1293 jbl-1426 jbl-745">
                                    <i data-lucide="check-square" width="16"></i> Persyaratan Pelayanan
                                </h4>
                                <div class="jbl-434 jbl-1406 jbl-1545 jbl-333 jbl-121 jbl-160 jbl-285">
                                    <div>
                                        <p class="jbl-959 jbl-386 jbl-166 jbl-1429">Aktivasi Identitas Kependudukan Digital (IKD):</p>
                                        <ul class="jbl-1405 jbl-660 jbl-166 jbl-1574 jbl-1327 jbl-1003">
                                            <li>Telah memiliki KTP-el Fisik atau pernah melakukan perekaman biometrik</li>
                                            <li>Memiliki Smartphone (Android / iOS)</li>
                                            <li>Memiliki alamat Email yang aktif</li>
                                            <li>Smartphone terhubung dengan koneksi internet</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Waktu & Biaya -->
                            <div class="jbl-174 jbl-1576 jbl-701">
                                <div class="jbl-434 jbl-1406 jbl-156 jbl-333 jbl-121 jbl-160">
                                    <p class="jbl-843 jbl-959 jbl-13 jbl-1462 jbl-1195">Jangka Waktu</p>
                                    <p class="jbl-166 jbl-959 jbl-386"><i data-lucide="clock" width="14" class="jbl-1189 jbl-1381 jbl-1457"></i> Langsung Aktif</p>
                                </div>
                                <div class="jbl-434 jbl-1406 jbl-156 jbl-333 jbl-121 jbl-160">
                                    <p class="jbl-843 jbl-959 jbl-13 jbl-1462 jbl-1195">Biaya / Tarif</p>
                                    <p class="jbl-166 jbl-959 jbl-625"><i data-lucide="check-circle" width="14" class="jbl-1189 jbl-1457"></i> GRATIS</p>
                                </div>
                            </div>

                            <!-- Dasar Hukum -->
                            <div>
                                <h4 class="jbl-1080 jbl-959 jbl-497 jbl-1462 jbl-422 jbl-1429 jbl-1293 jbl-1426 jbl-745">
                                    <i data-lucide="book-open" width="16"></i> Dasar Hukum
                                </h4>
                                <div class="jbl-995 jbl-1320 jbl-156 jbl-596 jbl-147 jbl-1003">
                                    <p>1. Permendagri No. 72 Tahun 2022 tentang Penyelenggaraan Identitas Kependudukan Digital.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Generic Default Content -->
                    <div x-show="!activeService.includes('KTP') && !activeService.includes('KIA') && !activeService.includes('IKD')" style="display: none;">
                        <div class="jbl-285">
                            <p class="jbl-1574 jbl-772 jbl-166">Berikut adalah persyaratan umum yang wajib dipenuhi sebelum melakukan pengajuan secara online:</p>
                            
                            <div class="jbl-434 jbl-1406 jbl-1545 jbl-333 jbl-1319 jbl-160 jbl-285">
                                <div class="jbl-1293 jbl-701 jbl-1046">
                                    <div class="jbl-1374 jbl-1224 jbl-835 jbl-176 jbl-184 jbl-1293 jbl-1426 jbl-141 jbl-959 jbl-166 jbl-795 jbl-1213">1</div>
                                    <p class="jbl-166 jbl-1397 jbl-431">Mempunyai akun SI JEBOL yang telah terverifikasi NIK-nya.</p>
                                </div>
                                <div class="jbl-1293 jbl-701 jbl-1046">
                                    <div class="jbl-1374 jbl-1224 jbl-835 jbl-176 jbl-184 jbl-1293 jbl-1426 jbl-141 jbl-959 jbl-166 jbl-795 jbl-1213">2</div>
                                    <p class="jbl-166 jbl-1397 jbl-431">Dokumen asli harus dipindai (scan) atau difoto dengan jelas, terang, dan berwarna.</p>
                                </div>
                                <div class="jbl-1293 jbl-701 jbl-1046">
                                    <div class="jbl-1374 jbl-1224 jbl-835 jbl-176 jbl-184 jbl-1293 jbl-1426 jbl-141 jbl-959 jbl-166 jbl-795 jbl-1213">3</div>
                                    <p class="jbl-166 jbl-1397 jbl-431">Format file yang didukung: JPG/PNG/PDF dengan ukuran maksimal 2MB per file.</p>
                                </div>
                                <div class="jbl-1293 jbl-701 jbl-1046">
                                    <div class="jbl-1374 jbl-1224 jbl-835 jbl-176 jbl-184 jbl-1293 jbl-1426 jbl-141 jbl-959 jbl-166 jbl-795 jbl-1213">4</div>
                                    <p class="jbl-166 jbl-1397 jbl-431">Pastikan Nomor WhatsApp yang terdaftar selalu aktif untuk notifikasi status berkas.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="jbl-434 jbl-725 jbl-371 jbl-1234 jbl-1319 jbl-1293 jbl-594 jbl-985">
                    <button @click="showDetailModal = false" type="button" class="jbl-823 jbl-1539 jbl-141 jbl-1320 jbl-1547 jbl-725 jbl-1569 jbl-166 jbl-959 jbl-1361 jbl-160 jbl-402 jbl-28 jbl-632">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>

